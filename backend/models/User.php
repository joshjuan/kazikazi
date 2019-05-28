<?php
namespace backend\models;

use frontend\models\Client;
use kartik\password\StrengthValidator;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $mobile
 * @property string $auth_key
 * @property integer $role
 * @property integer $user_type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
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
    const ACCOUNTANT=3;
    const SUPERVISOR=4;
    const CLERK=5;
    const GVT=6;

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

    public static function getArrayAssign()
    {
        return [
            self::ADMIN => Yii::t('app', 'ADMIN'),
            self::MANAGER => Yii::t('app', 'MANAGER'),
            self::ACCOUNTANT => Yii::t('app', 'ACCOUNTANT'),
            self::SUPERVISOR => Yii::t('app', 'SUPERVISOR'),
            self::CLERK => Yii::t('app', 'CLERK'),
            self::GVT => Yii::t('app', 'GOVERNMENT AGENT'),
        ];
    }

    public static function getArrayRole()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    public static function getClerk()
    {
        return ArrayHelper::map(User::find()->where(['user_type'=> User::CLERK])->all(),'id','username');
    }

    public static function getClerkFullName()
    {
        return ArrayHelper::map(User::find()->where(['user_type' =>  User::CLERK])->all(),'id',function($model) {
            return $model->username . ' ' . $model->name;
        });
    }

    public static function getSupervisorFullName()
    {
        return ArrayHelper::map(User::find()->where(['user_type' =>  User::SUPERVISOR])->all(),'id',function($model) {
            return $model->username . ' ( ' . $model->name.' )';
        });
    }

    public static function getgVTFullName()
    {
        return ArrayHelper::map(User::find()->where(['user_type' =>  User::GVT])->all(),'id',function($model) {
            return $model->username . ' ( ' . $model->name.' )';
        });
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
     * @inheritdoc
     */

    public function rules()
    {
        return [

            [['username','name','password','repassword','status','mobile','role','region'], 'required',],
            [['username', 'password', 'repassword'], 'trim'],
            [['password', 'repassword'], 'string', 'min' => 4, 'max' => 30],
            [['name','mobile'], 'string', 'max' => 255],
            [[ 'email'], 'unique'],
            [[ 'username'], 'unique'],
            ['username', 'string', 'min' => 3, 'max' => 30],
            ['email', 'string', 'max' => 100],
          //  ['email', 'email'],
           // ['user_id', 'integer'],
            //  [['password'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'username'],
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            //['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]], ['repassword', 'compare', 'compareAttribute' => 'password'],
            //['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],

        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'default' => ['username','name','mobile', 'email', 'password', 'repassword', 'status', 'role','region','district','municipal','street','work_area'],
            'createUser' => ['username','name','mobile', 'email', 'password', 'repassword', 'status', 'role'],
            'admin-update' => ['username','name','mobile', 'email', 'status', 'role']
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        return array_merge(
            $labels,
            [
                'password' => Yii::t('app', 'Password'),
                'name' => Yii::t('app', 'Name'),
                'mobile' => Yii::t('app', 'Mobile'),
                'municipal' => Yii::t('app', 'Shehia'),
                'street' => Yii::t('app', 'Zone'),
                'work_area' => Yii::t('app', 'Work Area'),
            ]
        );
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

    public function getStreet()
    {
        return $this->hasOne(Street::className(), ['id' => 'street']);
    }

    //gets all usernames


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

    public static function getRulesAccountant()
    {
        return ArrayHelper::map(AuthItem::find()->where(['type'=> 1,'name'=>'accountant'])->all(),'name','name');
    }

  public static function getRulesgGvt()
    {
        return ArrayHelper::map(AuthItem::find()->where(['type'=> 1,'name'=>'governmentOfficial'])->all(),'name','name');
    }


    public static function getRole()
    {
        return ArrayHelper::map(AuthItem::find()->where(['type'=>1])->all(),'name','name');
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