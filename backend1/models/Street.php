<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "street".
 *
 * @property int $id
 * @property string $name
 * @property int $region
 * @property int $district
 * @property int $municipal
 * @property string $created_at
 * @property string $created_by
 *
 * @property Municipal $municipal0
 * @property Region $region0
 * @property District $district0
 * @property TicketTransaction[] $ticketTransactions
 * @property User[] $users
 * @property WorkArea[] $workAreas
 */
class Street extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'street';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'region', 'district', 'municipal', 'created_at', 'created_by'], 'required'],
            [['region', 'district', 'municipal'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'created_by'], 'string', 'max' => 200],
            [['municipal'], 'exist', 'skipOnError' => true, 'targetClass' => Municipal::className(), 'targetAttribute' => ['municipal' => 'id']],
            [['region'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region' => 'id']],
            [['district'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district' => 'id']],
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
            'municipal' => 'Municipal',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipal0()
    {
        return $this->hasOne(Municipal::className(), ['id' => 'municipal']);
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
    public function getDistrict0()
    {
        return $this->hasOne(District::className(), ['id' => 'district']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketTransactions()
    {
        return $this->hasMany(TicketTransaction::className(), ['street' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['street' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkAreas()
    {
        return $this->hasMany(WorkArea::className(), ['street' => 'id']);
    }

    public static function getStreet()
    {
        return ArrayHelper::map(Street::find()->all(),'id','name');
    }
}
