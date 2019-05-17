<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TicketTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Ticket Transactions';
?>
<div class="received-cash-index" style="padding-top: 10px">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php Pjax::begin(); ?>

    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],

        [
            'attribute' => 'ref_no',
        ],
        [
            'attribute' => 'begin_time',
        ],
        [
            'attribute' => 'end_time',
        ],
        [
            'attribute' => 'municipal',
        ],
        [
            'attribute' => 'street',
        ],
        [
            'attribute' => 'work_area',
        ],

        [
            'attribute' => 'receipt_no',
        ],
        [
            'attribute' => 'amount',
        ],
        [
            'attribute' => 'car_no',
        ],

        'status',
        'create_at',
        //'created_by',

        [
            'attribute' => 'region',
            /*            'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->zone->zone_name);

                        },
                        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(\backend\models\Zones::find()->orderBy('id')->asArray()->all(), 'id', 'zone_name'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Kituo'],
                        'format' => 'raw'*/
        ],
        [
            'attribute' => 'district',
            /*      'value' => function ($model) {
                      return Html::a($model->location->name);

                  },
                  'filterType' => GridView::FILTER_SELECT2,
                  'filter' => ArrayHelper::map(\backend\models\Region::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                  'filterWidgetOptions' => [
                      'pluginOptions' => ['allowClear' => true],
                  ],
                  'filterInputOptions' => ['placeholder' => 'Shehia'],
                  'format' => 'raw'*/
        ],
        [
            'attribute' => 'user',
            /*            'vAlign' => 'middle',
                        'width' => '200px',
                        'value' => function ($model) {
                            if ($model->user->name != '') {
                                return Html::a($model->user->name);
                            } else {
                                return '';
                            }
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(\backend\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Karani'],
                        'format' => 'raw'*/
        ],


        [
            'attribute' => 'amount',
            'format' => ['decimal', 2],
            'pageSummary' => true,
            'footer' => false,

        ],
    ];


    // the GridView widget (you must use kartik\grid\GridView)
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'id' => 'grid',
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export'] // remove this row from export
            ]
        ],

        'pjax' => true,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => false,

        'floatHeaderOptions' => ['scrollingTop' => true],
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => '<strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> LIST OF TICKET PRINTED TRANSACTIONS </strong>',
            // 'before' => '<span class="text text-red"> *Eligible*</span>'
        ],
        'rowOptions' => function ($model) {
            return ['data-id' => $model->id];
        },

        'exportConfig' => [
            GridView::EXCEL => [
                'filename' => Yii::t('app', 'Taarifa za Makusanyo'),
                'showPageSummary' => true,
                'config' => [
                    'methods' => [
                        'SetHeader' => [
                            ['odd' => 'header', 'even' => 'header']
                        ],
                        'SetFooter' => [
                            ['odd' => 'header', 'even' => 'header']
                        ],
                    ],
                ],
                'options' => [
                    'title' => 'Custom Title',
                    'subject' => 'PDF export',
                    'keywords' => 'pdf'
                ],

            ],
            GridView::PDF => [
                'filename' => Yii::t('app', 'Taarifa za Makusanyo'),
                'showPageSummary' => true,
                'showHeader' => true,
                'showFooter' => false,

                'config' => [
                    'methods' => [
                        'SetHeader' => [
                            ['odd' => 'TAARIFA ZA MAKUSANYO', 'even' => 'MAKUSANYO']
                        ],
                        'SetFooter' => [
                            ['odd' => 'header', 'even' => 'header']
                        ],
                    ],
                ],
                'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

            ],
            GridView::JSON => [
                'filename' => Yii::t('app', 'Taarifa za Makusanyo'),
                'showPageSummary' => true,
                'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

            ],

        ],

    ]); ?>

    <?php Pjax::end(); ?>
</div>

