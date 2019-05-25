<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "supervisor_deni".
 *
 * @property int $id
 * @property int $name
 * @property string $collected_amount
 * @property string $submitted_amount
 * @property string $deni
 * @property string $amount_date
 * @property int $status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class SupervisorDeni extends \yii\db\ActiveRecord
{

    const COMPLETE=1;
    const NOT_COMPLETE=0;




    public static function getStatus()
    {
        return [
            self::COMPLETE => Yii::t('app', 'COMPLETE'),
            self::NOT_COMPLETE => Yii::t('app', 'NOT_COMPLETE'),

        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supervisor_deni';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'amount_date', 'created_at', 'created_by'], 'required'],
            [['name', 'status'], 'integer'],
            [['collected_amount', 'submitted_amount', 'deni'], 'number'],
            [['amount_date', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 200],
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
            'collected_amount' => 'Collected Amount',
            'submitted_amount' => 'Submitted Amount',
            'deni' => 'Deni',
            'amount_date' => 'Amount Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }


    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'name']);
    }
}
