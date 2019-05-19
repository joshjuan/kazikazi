<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $mobile
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $region
 * @property int $district
 * @property int $municipal
 * @property int $street
 * @property int $work_area
 * @property int $amount
 * @property int $user_type
 * @property string $status
 * @property string $role
 * @property int $created_at
 * @property int $updated_at
 * @property string $last_login
 *
 * @property TicketTransaction[] $ticketTransactions
 */
class User extends \common\models\User

{


    public $password;
    public $repassword;
    private $_statusLabel;
    private $_roleLabel;
    private $role_name;

    const STATUS_ACTIVE=10;
    const STATUS_INACTIVE=1;
    const STATUS_DELETED=0;

    const SUPER_ADMIN=0;
    const ADMIN=1;
    const MANAGER=2;
    const SUPERVISOR=3;
    const CLERK=4;



    /**
     * @inheritdoc
     */
    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) {
            $statuses = self::getArrayStatus();
            $this->_statusLabel = $statuses[$this->status];
        }
        return $this->_statusLabel;
    }

    /**
     * @inheritdoc
     */
    public static function getArrayStatus()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'STATUS_ACTIVE'),
            self::STATUS_INACTIVE => Yii::t('app', 'STATUS_INACTIVE'),
            self::STATUS_DELETED => Yii::t('app', 'STATUS_DELETED'),
        ];
    }

    public static function getArrayRole()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    public function getRoleLabel()
    {

        if ($this->_roleLabel === null) {
            $roles = self::getArrayRole();
            $this->_roleLabel = $roles[$this->role];
        }
        return $this->_roleLabel;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          //  [['name', 'username', 'mobile', 'auth_key', 'password_hash', 'email', 'region', 'district', 'municipal', 'street', 'work_area', 'user_type', 'role', 'created_at', 'updated_at'], 'required'],
            [['region', 'district', 'municipal', 'street', 'work_area', 'amount', 'user_type', 'created_at', 'updated_at'], 'integer'],
            [['last_login'], 'safe'],
            [['name', 'username', 'mobile', 'password_hash', 'password_reset_token', 'email', 'status', 'role'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Username',
            'mobile' => 'Mobile',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'region' => 'Region',
            'district' => 'District',
            'municipal' => 'Municipal',
            'street' => 'Street',
            'work_area' => 'Work Area',
            'amount' => 'Amount',
            'user_type' => 'User Type',
            'status' => 'Status',
            'role' => 'Role',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_login' => 'Last Login',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketTransactions()
    {
        return $this->hasMany(TicketTransaction::className(), ['user' => 'id']);
    }


    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->generatePasswordResetToken();
            }
            return true;
        }
        return false;
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    //gets all usernames

    public static function getRules()
    {
        return ArrayHelper::map(AuthItem::find()->where(['type'=> 1])->all(),'name','name');
    }

    public static function getRulesManager()
    {
        return ArrayHelper::map(AuthItem::find()->where(['type'=> 1,'name'=>'manager'])->all(),'name','name');
    }

 public static function getRulesAdmin()
    {
        return ArrayHelper::map(AuthItem::find()->where(['type'=> 1,'name'=>'admin'])->all(),'name','name');
    }

    public static function getRulesSupervisor()
    {
        return ArrayHelper::map(AuthItem::find()->where(['type'=> 1,'name'=>'supervisor'])->all(),'name','name');
    }

    public static function getRulesClerk()
    {
        return ArrayHelper::map(AuthItem::find()->where(['type'=> 1,'name'=>'clerk'])->all(),'name','name');
    }


    public function getDistrict0()
    {
        return $this->hasOne(District::className(), ['id' => 'district']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRegion0()
    {
        return $this->hasOne(Region::className(), ['id' => 'region']);
    }

    public function getMunicipal0()
    {
        return $this->hasOne(Municipal::className(), ['id' => 'municipal']);
    }

    public function getStreet0()
    {
        return $this->hasOne(Street::className(), ['id' => 'street']);
    }

    public static function getRegionNameByuserId($user_id)
    {
        $mfanyakazi = User::findOne($user_id);
        if($mfanyakazi != null){
            $zone = Region::findOne($mfanyakazi->region);
            if($zone != null) {
                return $zone->name;
            }else{
                return ' ';
            }
        }else{
            return '';
        }
    }

    public static function getDistrictNameByuserId($user_id)
    {
        $mfanyakazi = User::findOne($user_id);
        if($mfanyakazi != null){
            $zone = District::findOne($mfanyakazi->district);
            if($zone != null) {
                return $zone->name;
            }else{
                return ' ';
            }
        }else{
            return '';
        }
    }

    public static function getMunicipalNameByuserId($user_id)
    {
        $mfanyakazi = User::findOne($user_id);
        if($mfanyakazi != null){
            $zone = Municipal::findOne($mfanyakazi->municipal);
            if($zone != null) {
                return $zone->name;
            }else{
                return ' ';
            }
        }else{
            return '';
        }
    }



    public function getWorkAreas()
    {
        return $this->hasOne(WorkArea::className(), ['id' => 'work_area']);
    }

    public static function getClerkInMkoaCount($id)
    {

        $shehia = User::find()->where(['user_type' => 4])->count();
        if($shehia != null){
            return $shehia;
        }else{
            return 0;
        }

    }
}
