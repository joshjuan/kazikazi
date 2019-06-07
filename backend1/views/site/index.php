
<?php

/* @var $this yii\web\View */
ini_set('memory_limit', '1024M');

use bsadnu\googlecharts\PieChart;
use kartik\select2\Select2;

use miloschuman\highcharts\Highcharts;
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

    <div class="site-index" id="grid" style="padding-top: 10px">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-calculator"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumla</span>
                        <span class="info-box-number">
                        <?= \backend\models\TicketTransaction::getTodayTotal() ?>
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green-gradient"><i class="fa fa-sitemap"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ZONE 1</span>
                        <span class="info-box-number">
                        <?= \backend\models\TicketTransaction::getTodayTotalZone1() ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light-blue-gradient"><i class="fa fa-tree"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ZONE 2</span>
                        <span class="info-box-number">
                        <?= \backend\models\TicketTransaction::getTodayTotalZone2() ?>
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-gavel"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ZONE 3</span>
                        <span class="info-box-number">
                       <?= \backend\models\TicketTransaction::getTodayTotalZone3() ?>
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
    </div>
    <div class="site-index" id="grid" style="padding-top: 10px">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ZONE 4</span>
                        <span class="info-box-number">
                                <?= \backend\models\TicketTransaction::getTodayTotalZone4() ?>
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green-gradient"><i class="fa fa-sitemap"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ZONE 5</span>
                        <span class="info-box-number">
                         <?= \backend\models\TicketTransaction::getTodayTotalZone5() ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light-blue-gradient"><i class="fa fa-tree"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ZONE 6</span>
                        <span class="info-box-number">
                         <?= \backend\models\TicketTransaction::getTodayTotalZone6() ?>
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-gavel"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ZONE 7</span>
                        <span class="info-box-number">
                      <?= \backend\models\TicketTransaction::getTodayTotalZone7() ?>
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

    </div>
</div>
<div class="row" style="padding-top: 20px">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i
                            class="fa fa-bar-chart"></i> <?php echo Yii::t('app', 'Chati ya makusanyo kwa sehemu za kazi Masaa 24 kwa tarehe ');
                    echo date('d Y'); ?>
                </h3>
                <div class="box-tools">
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>

            </div>
            <div class="box-body">
                <?php
                $searchModel1 = new \backend\models\TicketTransactionSearch();
                $dataProvider1 = $searchModel1->Chart();
                ?>
                <?=
                \sjaakp\gcharts\ColumnChart::widget([
                    'height' => '400px',
                    'dataProvider' => $dataProvider1,
                    'columns' => [

                        [
                            'attribute' => 'work_area',
                            'value' => function ($model) {
                                if ($model->workArea->name != null) {
                                    return $model->workArea->name;
                                } else {
                                    return '';
                                }
                            },

                            'type' => 'string',
                        ],
                        'amount',
                    ],

                ])
                ?>
            </div>
            <!-- /.box-body -->

        </div>
    </div>

</div>


