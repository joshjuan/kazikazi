<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%day_amount_setup}}".
 *
 * @property int $id
 * @property string $amount
 * @property string $created_at
 * @property string $created_by
 */
class DayAmountSetup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%day_amount_setup}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'required'],
            [['amount'], 'number'],
            [['created_at'], 'safe'],
            [['created_by'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
