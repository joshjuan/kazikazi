<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ticket_reprinted".
 *
 * @property int $id
 * @property string $ref_no
 * @property string $begin_time
 * @property string $end_time
 * @property string $region
 * @property string $district
 * @property string $municipal
 * @property string $street
 * @property string $work_area
 * @property string $receipt_no
 * @property string $amount
 * @property string $car_no
 * @property int $user
 * @property int $status
 * @property string $create_at
 * @property string $created_by
 * @property int $report_no
 */
class TicketReprinted extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_reprinted';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref_no', 'begin_time', 'end_time', 'region', 'district', 'municipal', 'street', 'work_area', 'receipt_no', 'amount', 'car_no', 'user', 'create_at'], 'required'],
            [['begin_time', 'end_time', 'create_at'], 'safe'],
            [['amount'], 'number'],
            [['user', 'status', 'report_no'], 'integer'],
            [['ref_no', 'region', 'district', 'municipal', 'street', 'work_area', 'receipt_no', 'car_no', 'created_by'], 'string', 'max' => 200],
            [['ref_no'], 'unique'],
            [['receipt_no'], 'unique'],
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
            'report_no' => 'Report No',
        ];
    }
}
