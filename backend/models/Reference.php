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
                $reference =date('Ymd').'TMG'.sprintf("%08d", count($model) + 1);
            return $reference;
        }
        else {

            $reference =date('Ymd').'TMG'.'000000001';
            return $reference;

        }

    }


}