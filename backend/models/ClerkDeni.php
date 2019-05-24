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
 * @property string $updated_at
 * @property string $updated_by
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
            [['name','status'], 'integer'],
            [['collected_amount', 'submitted_amount', 'deni', 'total_amount'], 'number'],
            [['amount_date', 'created_at','updated_at'], 'safe'],
            [['created_by','updated_by'], 'string', 'max' => 200],
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
            'amount_date' => 'Tarehe ya Kazi',
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

}
