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

    public static function getTodayTotal()
    {
        $date=date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)'=>$date])->andWhere(['status'=>0])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications=0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }


    public static function getTodayTotalMaghalibiliA()

    {
        $date=date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)'=>$date])->andWhere(['district'=>1])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications=0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }


    public static function getTodayTotalMaghalibiliB()

    {
        $date=date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)'=>$date])->andWhere(['district'=>2])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications=0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }
    public static function getTodayTotalMjiniMaghalibili()

    {
        $date=date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)'=>$date])->andWhere(['district'=>3])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications=0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }

    public static function getSum($id)
    {


        return TicketTransaction::find()
            ->select(['user,sum(amount) amount'])
            ->groupBy(['user'])->sum('amount');
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref_no', 'begin_time', 'end_time', 'region', 'district', 'municipal', 'street', 'work_area', 'receipt_no', 'amount', 'car_no', 'user', 'create_at'], 'required'],
            [['begin_time', 'end_time', 'create_at'], 'safe'],
            [['user','status'], 'integer'],
            [['ref_no','receipt_no'], 'unique'],
            [['amount'], 'number'],
            [['ref_no', 'car_no', 'created_by','receipt_no','region', 'district', 'municipal', 'street', 'work_area'], 'string', 'max' => 200],
            [['region', 'district', 'municipal', 'street', 'work_area', 'user'], 'integer'],
            [['amount'], 'number'],
            [['ref_no', 'car_no','receipt_no', 'created_by'], 'string', 'max' => 200],
            [['district'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district' => 'id']],
            [['municipal'], 'exist', 'skipOnError' => true, 'targetClass' => Municipal::className(), 'targetAttribute' => ['municipal' => 'id']],
            [['region'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region' => 'id']],
            [['street'], 'exist', 'skipOnError' => true, 'targetClass' => Street::className(), 'targetAttribute' => ['street' => 'id']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
            [['work_area'], 'exist', 'skipOnError' => true, 'targetClass' => WorkArea::className(), 'targetAttribute' => ['work_area' => 'id']],
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
            'municipal' => 'Shehia',
            'street' => 'Zone',
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
        return $this->hasOne(WorkArea::className(), ['id' => 'work_area']);
    }


}
