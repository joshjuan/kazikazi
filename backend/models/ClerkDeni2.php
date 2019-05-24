<?php

namespace backend\models;

use backend\models\TicketTransaction;
use Yii;

/**
 * This is the model class for table "clerk_deni".
 *
 * @property int $id
 * @property int $name
 * @property int $supervisor
 * @property string $collected_amount
 * @property string $submitted_amount
 * @property string $deni
 * @property string $total_amount
 * @property string $status
 * @property string $amount_date
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property User $supervisor0
 * @property User $name0
 */
class ClerkDeni extends \yii\db\ActiveRecord
{

    const COMPLETE = 1;
    const NOT_COMPLETE = 0;

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
            [['name', 'supervisor'], 'integer'],
            [['collected_amount', 'submitted_amount', 'deni', 'total_amount'], 'number'],
            [['amount_date', 'created_at', 'updated_at'], 'safe'],
            [['status', 'created_by', 'updated_by'], 'string', 'max' => 200],
            [['supervisor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['supervisor' => 'id']],
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
            'supervisor' => 'Supervisor',
            'collected_amount' => 'Collected Amount',
            'submitted_amount' => 'Submitted Amount',
            'deni' => 'Deni',
            'total_amount' => 'Total Amount',
            'status' => 'Status',
            'amount_date' => 'Amount Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisor0()
    {
        return $this->hasOne(User::className(), ['id' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName0()
    {
        return $this->hasOne(User::className(), ['id' => 'name']);
    }

    public static function getClerkDifference()
    {
        return (TicketTransaction::find()->select(['user', 'amount', 'create_at'])->groupBy(['user'])->groupBy(['create_at'])->sum('amount') - \backend\models\ClerkDeni::find()->sum('	submitted_amount	'));
    }
}
