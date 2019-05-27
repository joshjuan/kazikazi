<?php
namespace common\models;

use backend\models\AuthItem;
use backend\models\District;
use backend\models\Municipal;
use backend\models\Region;
use backend\models\Street;
use backend\models\WorkArea;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE=1;
    const STATUS_ACTIVE = 10;


    const SUPER_ADMIN=0;
    const ADMIN=1;
    const MANAGER=2;
    const SUPERVISOR=3;
    const CLERK=4;







    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
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

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }



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

    public function getStreet0()
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



    public function getWork()
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
