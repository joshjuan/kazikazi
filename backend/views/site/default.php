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
            <div class="col-md-3 col-sm-5 col-xs-8">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-ios-pricetag-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">TODAY TOTAL COLLECTION</span>
                        <span class="info-box-number">

                    <?= \backend\models\TicketTransaction::getTodayTotal() ?>
                        </span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 80%"></div>
                        </div>
                        <span class="progress-description">
                               24 Hours collection amount
                           </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-5 col-xs-8">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">MAGHARIBI A TOTAL</span>

                        <span class="info-box-number">

                           <?= \backend\models\TicketTransaction::getTodayTotalMaghalibiliA() ?>
                        </span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 20%"></div>
                        </div>
                        <span class="progress-description">
                           24 Hours collection amount
                         </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-3 col-sm-5 col-xs-8">
                <!-- /.info-box -->
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">MAGHARIBI B TOTAL</span>

                        <span class="info-box-number">
                            <?= \backend\models\TicketTransaction::getTodayTotalMaghalibiliB() ?>
                        </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                      24 Hours collection amount
                  </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3 col-sm-5 col-xs-8">
                <!-- /.info-box -->
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">MJINI MAGHALIBI TOTAL</span>

                        <span class="info-box-number">
                            <?= \backend\models\TicketTransaction::getTodayTotalMjiniMaghalibili() ?>
                        </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 54%"></div>
                        </div>
                        <span class="progress-description">
                      24 Hours collection amount
                  </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
    </div>
</div>
<p style="padding-top: 20px"/>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i
                            class="fa fa-bar-chart"></i> <?php echo Yii::t('app', 'Chati ya makusanyo kwa shehia Masaa 24 kwa tarehe ');
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
                            'attribute' => 'municipal',
                            'value' => function ($model) {
                                if ($model->municipal0->name != null) {
                                    return $model->municipal0->name;
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

>>>>>>> 4a9cae9c855817ff6b5748ce3c6b3d72d3c4654d
