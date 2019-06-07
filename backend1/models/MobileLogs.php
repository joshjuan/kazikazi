<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mobile_logs".
 *
 * @property int $id
 * @property string $username
 * @property string $imei_no
 * @property string $last_logoin_time
 */
class MobileLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mobile_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'imei_no', 'last_logoin_time'], 'required'],
            [['last_logoin_time'], 'safe'],
            [['username', 'imei_no'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'imei_no' => 'Imei No',
            'last_logoin_time' => 'Last Logoin Time',
        ];
    }
}
