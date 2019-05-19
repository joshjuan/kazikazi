<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ticket_transaction".
 *
 * @property int $id
 * @property string $ref_no
 * @property string $begin_time
 * @property string $end_time
 * @property int $region
 * @property int $district
 * @property int $municipal
 * @property int $street
 * @property int $work_area
 * @property int $receipt_no
 * @property string $amount
 * @property string $car_no
 * @property int $user
 * @property string $status
 * @property string $create_at
 * @property string $created_by
 *
 * @property District $district0
 * @property Municipal $municipal0
 * @property Region $region0
 * @property Street $street0
 * @property User $user0
 * @property User $workArea
 */
class TicketTransaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref_no', 'begin_time', 'end_time', 'region', 'district', 'municipal', 'street', 'work_area', 'receipt_no', 'amount', 'car_no', 'user', 'status', 'create_at', 'created_by'], 'required'],
            [['begin_time', 'end_time', 'create_at'], 'safe'],
            [['region', 'district', 'municipal', 'street', 'work_area', 'receipt_no', 'user'], 'integer'],
            [['amount'], 'number'],
            [['ref_no', 'car_no', 'status', 'created_by'], 'string', 'max' => 200],
            [['district'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district' => 'id']],
            [['municipal'], 'exist', 'skipOnError' => true, 'targetClass' => Municipal::className(), 'targetAttribute' => ['municipal' => 'id']],
            [['region'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region' => 'id']],
            [['street'], 'exist', 'skipOnError' => true, 'targetClass' => Street::className(), 'targetAttribute' => ['street' => 'id']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
            [['work_area'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['work_area' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_no' => 'Ref No',
            'begin_time' => 'Begin Time',
            'end_time' => 'End Time',
            'region' => 'Region',
            'district' => 'District',
            'municipal' => 'Municipal',
            'street' => 'Street',
            'work_area' => 'Work Area',
            'receipt_no' => 'Receipt No',
            'amount' => 'Amount',
            'car_no' => 'Car No',
            'user' => 'User',
            'status' => 'Status',
            'create_at' => 'Create At',
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
    public function getStreet0()
    {
        return $this->hasOne(Street::className(), ['id' => 'street']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkArea()
    {
        return $this->hasOne(User::className(), ['id' => 'work_area']);
    }

    public static function getSum($id)
    {
        return TicketTransaction::find()->sum('amount');
    }
}
