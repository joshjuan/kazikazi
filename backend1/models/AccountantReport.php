<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "accountant_report".
 *
 * @property int $id
 * @property string $collected_amount
 * @property string $submitted_amount
 * @property string $difference
 * @property string $collected_date
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $report_no
 * @property string $receipt_no
 * @property string $uploaded_receipt
 * @property int $report_status
 */
class AccountantReport extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accountant_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
            [['file'], 'file', 'extensions' => 'pdf,png,jpg,jpeg,doc', 'skipOnEmpty' => true,
                'checkExtensionByMimeType' => false],

            [['collected_amount', 'submitted_amount', 'difference'], 'number'],
            [['collected_date','submitted_amount', 'created_at', 'created_by'], 'required'],
            [['collected_date', 'created_at', 'updated_at'], 'safe'],
            [['report_status','report_no'], 'integer'],
            [['created_by', 'updated_by', 'receipt_no', 'uploaded_receipt'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'collected_amount' => 'Collected Amount',
            'submitted_amount' => 'Submitted Amount',
            'difference' => 'Difference',
            'collected_date' => 'Collected Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'receipt_no' => 'Receipt No',
            'uploaded_receipt' => 'Uploaded Receipt',
            'report_status' => 'Report Status',
        ];
    }
}
