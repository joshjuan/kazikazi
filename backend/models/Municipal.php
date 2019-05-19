<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "municipal".
 *
 * @property int $id
 * @property string $name
 * @property int $region
 * @property int $district
 * @property string $created_at
 * @property string $created_by
 *
 * @property District $district0
 * @property Region $region0
 * @property Street[] $streets
 * @property TicketTransaction[] $ticketTransactions
 * @property User[] $users
 * @property WorkArea[] $workAreas
 */
class Municipal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'region', 'district', 'created_at', 'created_by'], 'required'],
            [['region', 'district'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'created_by'], 'string', 'max' => 200],
            [['district'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district' => 'id']],
            [['region'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region' => 'id']],
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
            'region' => 'Region',
            'district' => 'District',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict0()
    {
        return $this->hasOne(District::className(), ['id' => 'district']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion0()
    {
        return $this->hasOne(Region::className(), ['id' => 'region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreets()
    {
        return $this->hasMany(Street::className(), ['municipal' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketTransactions()
    {
        return $this->hasMany(TicketTransaction::className(), ['municipal' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['municipal' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkAreas()
    {
        return $this->hasMany(WorkArea::className(), ['municipal' => 'id']);
    }

    public static function getMunicipal()
    {
        return ArrayHelper::map(Municipal::find()->where(['district'=>Yii::$app->user->identity->district])->all(),'id','name');
    }

    public static function getMunicipalCout($id)
    {

        $municipalID = Municipal::find()->count();
        if($municipalID != null){
            return $municipalID;
        }else{
            return 0;
        }

    }
}
