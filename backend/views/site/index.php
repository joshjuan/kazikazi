<?php

/* @var $this yii\web\View */
ini_set('memory_limit', '1024M');

use kartik\select2\Select2;

use yii\web\JsExpression;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = '';
?>

<div class="site-index" style="font-size: 12px; font-family: Tahoma, sans-serif">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
            <strong class="lead">PARKING MIS - Dashboard</strong>
        </div>
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

        </div>
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12 text-right">
            <strong class="lead">
                <small> Date: <?= date('Y-m-d'); ?></small>
            </strong>
        </div>
    </div>
</div>