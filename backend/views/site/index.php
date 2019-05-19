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

        <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-ios-pricetag-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Inventory</span>
                    <span class="info-box-number">5,200</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <span class="progress-description">
                    50% Increase in 30 Days
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Mentions</span>
                    <span class="info-box-number">92,050</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 20%"></div>
                    </div>
                    <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Downloads</span>
                    <span class="info-box-number">114,381</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Direct Messages</span>
                    <span class="info-box-number">163,921</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 40%"></div>
                    </div>
                    <span class="progress-description">
                    40% Increase in 30 Days
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
</div>