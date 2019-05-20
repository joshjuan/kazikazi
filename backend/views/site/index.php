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
            <div class="col-md-4 col-sm-6 col-xs-12">
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
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">MAGHARIBI A TOTAL</span>
                        <span class="info-box-number"> <?= \backend\models\TicketTransaction::getTodayTotalMaghalibiliA() ?></span>

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
            <div class="col-md-4 col-sm-6 col-xs-12">
                <!-- /.info-box -->
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">MAGHARIBI B TOTAL</span>
                        <span class="info-box-number"><?= \backend\models\TicketTransaction::getTodayTotalMaghalibiliB() ?></span>

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
        </div>
    </div>
</div>

<div class="row" style="padding-top: 30px" />

    <div class="col-md-6">
        <div class="box box-solid bg-light-blue-gradient ">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">PARKING MIS -  </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <?php

                 $val1 =\backend\models\TicketTransaction::getTodayTotalMaghalibiliA() ;
                $val2= \backend\models\TicketTransaction::getTodayTotalMaghalibiliB() ;


                echo PieChart::widget([
                    'id' => 'my-pie-chart-id',
                    'data' => [
                        ['Major', 'MAGHALIBI A'],
                        ['Income Sources', 13],
                        ['All Expenses', 14],

                    ],

                ]) ?>
            </div>
            <!-- /.box-body -->

        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">PARKING MIS - </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <?php

                $val1 =\backend\models\TicketTransaction::getTodayTotalMaghalibiliA() ;
                $val2= \backend\models\TicketTransaction::getTodayTotalMaghalibiliB() ;


                echo PieChart::widget([
                    'id' => 'my-pie-chart-id',
                    'data' => [
                        ['Major', 'Degrees'],
                        ['MAGHALIBI A', $val1],
                        ['MAGHALIBI B', $val2],
                        //  ['Dodoma', 66],


                    ],


                ]) ?>
            </div>
            <!-- /.box-body -->

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">PARKING MIS - Total work area per zone </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <?php

                $val1 =\backend\models\TicketTransaction::getTodayTotalMaghalibiliA() ;
                $val2= \backend\models\TicketTransaction::getTodayTotalMaghalibiliB() ;


                echo Highcharts::widget([
                    'options' => [
                        'title' => '',
                        'xAxis' => [
                            'categories' => ['']
                        ],
                        'yAxis' => [
                            'title' => ['text' => '']
                        ],
                        'credits' => [
                            'enabled' => false
                        ],
                        'chart' => [
                            'type' => 'column',
                            'margin' => 80,
                            'options3d' => [
                                'enabled' => true,
                                'alpha' => 0,
                                'beta' => 0,
                                'depth' => 100
                            ],

                        ],
                        'series' => [
                            ['name' => 'MAGHALIBI A',
                                'data' => [$val1]
                            ],
                            ['name' => 'MAGHALIBI B',
                                'data' => [$val2]
                            ],


                        ]
                    ]
                ]);
                ?>
            </div>
            <!-- /.box-body -->

        </div>
    </div>

</div>

