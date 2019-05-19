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
            <strong class="lead"><small> Date: <?= date('Y-m-d');?></small></strong>
        </div>
    </div>
    <hr/>
</div>


<div class="row">

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

                /* $command4 = Yii::$app->db->createCommand("SELECT IFNULL(SUM(	total_amount),0) FROM income_sources ");
                 $sum3 = $command4->queryScalar();
                 $val3 = intval($sum3);

                 $command4 = Yii::$app->db->createCommand("SELECT IFNULL(SUM(	total_amaount),0) FROM all_expenses ");
                 $sum4 = $command4->queryScalar();
                 $val4 = intval($sum4);*/


                echo PieChart::widget([
                    'id' => 'my-pie-chart-id',
                    'data' => [
                        ['Major', 'Degrees'],
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

               /* $command4 = Yii::$app->db->createCommand("SELECT IFNULL(SUM(	total_amount),0) FROM income_sources ");
                $sum3 = $command4->queryScalar();
                $val3 = intval($sum3);

                $command4 = Yii::$app->db->createCommand("SELECT IFNULL(SUM(	total_amaount),0) FROM all_expenses ");
                $sum4 = $command4->queryScalar();
                $val4 = intval($sum4);*/


                echo PieChart::widget([
                    'id' => 'my-pie-chart-id',
                    'data' => [
                        ['Major', 'Degrees'],
                        ['Income Sources', 23],
                        ['All Expenses', 11],
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

                /*  $command = Yii::$app->db->createCommand("SELECT IFNULL(SUM(	amount_recieved),0) FROM transport_fees ");
                  $sum1 = $command->queryScalar();
                  $val1 = intval($sum1);

                  $command = Yii::$app->db->createCommand("SELECT IFNULL(SUM(	amount_recieved),0) FROM waiting_charges ");
                  $sum2 = $command->queryScalar();
                  $val2 = intval($sum2);

                  $command = Yii::$app->db->createCommand("SELECT IFNULL(SUM(	amount),0) FROM personal_investment ");
                  $sum3 = $command->queryScalar();
                  $val3 = intval($sum3);*/


                echo Highcharts::widget([
                    'options' => [
                        'title' => '',
                        'xAxis' => [
                            'categories' => ['']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Area']
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
                            ['name' => 'Transport Fees',
                                'data' => [17]
                            ],
                            ['name' => 'Waiting Charges',
                                'data' => [2]
                            ],
                            ['name' => 'Personal Investment',
                                'data' => [59]
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
