<?php

namespace backend\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $created_by
 *
 * @property District[] $districts
 * @property Municipal[] $municipals
 * @property Street[] $streets
 * @property TicketTransaction[] $ticketTransactions
 * @property User[] $users
 * @property WorkArea[] $workAreas
 */
class Region extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'created_by'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'unique'],
            [['name', 'created_by'], 'string', 'max' => 200],
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
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['region' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMunicipals()
    {
        return $this->hasMany(Municipal::className(), ['region' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getStreets()
    {
        return $this->hasMany(Street::className(), ['region' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTicketTransactions()
    {
        return $this->hasMany(TicketTransaction::className(), ['region' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['region' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getWorkAreas()
    {
        return $this->hasMany(WorkArea::className(), ['region' => 'id']);
    }


    public static function getRegion()
    {
        if (Yii::$app->user->can('super_admin')){
            return ArrayHelper::map(Region::find()->all(),'id','name');
        }
        else{
            return ArrayHelper::map(Region::find()->where(['id'=>Yii::$app->user->identity->region])->all(),'id','name');
        }

    }
}
