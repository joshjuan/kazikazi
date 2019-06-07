<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "district".
 *
 * @property int $id
 * @property string $name
 * @property int $region
 * @property string $create_at
 * @property string $created_by
 *
 * @property Region $region0
 * @property Municipal[] $municipals
 * @property Street[] $streets
 * @property TicketTransaction[] $ticketTransactions
 * @property User[] $users
 * @property WorkArea[] $workAreas
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'region', 'create_at', 'created_by'], 'required'],
            [['region'], 'integer'],
            [['create_at'], 'safe'],
            [['name', 'created_by'], 'string', 'max' => 200],
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
            'create_at' => 'Create At',
            'created_by' => 'Created By',
        ];
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
    public function getMunicipals()
    {
        return $this->hasMany(Municipal::className(), ['district' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreets()
    {
        return $this->hasMany(Street::className(), ['district' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketTransactions()
    {
        return $this->hasMany(TicketTransaction::className(), ['district' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['district' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkAreas()
    {
        return $this->hasMany(WorkArea::className(), ['district' => 'id']);
    }


    public static function getDistrict()
    {
        return ArrayHelper::map(District::find()->all(),'id','name');
    }

    public static function getDistrictCout($id)
    {

        $districtID = District::find()->count();
        if($districtID != null){
            return $districtID;
        }else{
            return 0;
        }

    }
}
