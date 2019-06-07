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
 * @property string $report_no
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
        $date = date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)' => $date])->andWhere(['status' => 0])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications = 0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }


    public static function getTodayTotalZone1()

    {
        $date = date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)' => $date])->andWhere(['street' => 1])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications = 0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }


    public static function getTodayTotalZone2()

    {
        $date = date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)' => $date])->andWhere(['street' => 2])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications = 0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }

    public static function getTodayTotalZone3()

    {
        $date = date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)' => $date])->andWhere(['street' => 3])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications = 0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }

    public static function getTodayTotalZone4()

    {
        $date = date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)' => $date])->andWhere(['street' => 4])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications = 0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }

    public static function getTodayTotalZone5()

    {
        $date = date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)' => $date])->andWhere(['street' => 5])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications = 0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }

    public static function getTodayTotalZone6()

    {
        $date = date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)' => $date])->andWhere(['street' => 6])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications = 0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }

    public static function getTodayTotalZone7()

    {
        $date = date('Y-m-d');
        $applications = TicketTransaction::find()->where(['date(create_at)' => $date])->andWhere(['street' => 7])->sum('amount');
        if ($applications > 0) {
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        } else {
            $applications = 0;
            $amount_paid_today = number_format($applications, 2, '.', ',');
            return $amount_paid_today;
        }
    }


}
