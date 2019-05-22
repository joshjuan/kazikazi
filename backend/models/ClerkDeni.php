<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "clerk_deni".
 *
 * @property int $id
 * @property int $name
 * @property string $collected_amount
 * @property string $submitted_amount
 * @property string $deni
 * @property string $total_amount
 * @property string $amount_date
 * @property string $created_at
 * @property string $created_by
 * @property string $status
 *
 * @property User $name0
 */
class ClerkDeni extends \yii\db\ActiveRecord
{
    const COMPLETE=1;
    const NOT_COMPLETE=0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clerk_deni';
    }

    /**
     * @inheritdoc
     */
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
    public function rules()
    {
        return [
            [['name', 'amount_date', 'created_at', 'created_by'], 'required'],
            ['status', 'string', 'max' => 200],
            [['name'], 'integer'],
            [['collected_amount', 'submitted_amount', 'deni', 'total_amount'], 'number'],
            [['amount_date', 'created_at'], 'safe'],
            [['created_by'], 'string', 'max' => 200],
            [['name'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['name' => 'id']],
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
            'status' => 'Status',
            'total_amount' => 'Total Amount',
            'amount_date' => 'Work Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'name']);
    }

    public static function getClerkDifference()
    {
        return ( TicketTransaction::find()->select(['user','amount','create_at'])->groupBy(['user'])->groupBy(['create_at'])->sum('amount')- ClerkDeni::find()->sum('	submitted_amount	')) ;
    }
}
