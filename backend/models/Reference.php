<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 5/16/18
 * Time: 3:29 PM
 */

namespace backend\models;


class Reference
{

    public $reference;

    public static function findLast()
    {

        $model = TicketTransaction::find()->all();

        if ($model != null) {
                $reference =date('Ymd').'SMZ'.sprintf("%06d", count($model) + 1);
            return $reference;
        }
        else {

            $reference =date('Ymd').'SMZ'.'0000001';
            return $reference;

        }

    }


}