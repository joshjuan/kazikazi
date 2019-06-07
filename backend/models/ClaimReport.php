<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "claim_report".
 *
 * @property int $id
 * @property string $plate_no
 * @property string $upload
 * @property string $comment
 * @property string $created_at
 * @property string $created_by
 */
class ClaimReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'claim_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plate_no', 'comment', 'created_at',], 'required'],
            [['created_at'], 'safe'],
            [['plate_no', 'upload', 'comment', 'created_by'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plate_no' => 'Namba ya gari',
            'upload' => 'Picha',
            'comment' => 'Maelezo',
            'created_at' => 'Mda',
            'created_by' => 'Aliyelipoti (Karani)',
        ];
    }

    public function getUserClerk()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
