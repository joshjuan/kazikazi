<?php

use backend\models\ClerkDeni;
use backend\models\ClerkDeniSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClerkDeniSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Supervisor Deni';
?>
<p style="padding-top: 10px"/>
<div class="clerk-deni-index">

    <?php echo $this->render('_searchGvt', ['model' => $searchModel]); ?>
    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
          //  'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],

        [
            'attribute' => 'updated_at',
            'label' => 'Tarehe',
            'pageSummary' => 'JUMLA',
            'format'=>['DateTime','php:Y-m-d'],
        ],
        'receipt_no',
        [
            'header' => 'Bank Slip',
            'format' => 'raw',
            'value' => function ($model) {
                if ($model->uploaded_receipt == null) {
                    return '';
                } elseif ($model->uploaded_receipt != null) {
                    $basepath = Yii::$app->request->baseUrl . '/documents/' . $model->uploaded_receipt;
                    return Html::a('<i class="fa fa-folder-open text-green"></i>', $basepath, ['target'=>'_blank', 'data-pjax'=>"0"]);
                }
            }

        ],
        [
            'attribute' => 'updated_by',
            'label' => 'Aliyethibitisha',
            'pageSummary' => 'JUMLA',
        ],
        [
            'attribute' => 'collected_amount',
            'pageSummary' => true,
            'label'=>'Kiasi Kilicho Kusanywa',
            'format' => ['decimal', 2],
        ],
        [
            'class'=>'kartik\grid\ActionColumn',
            'header'=>'Print',
            'template'=>'{view}',
            'buttons'=>[
                'view' => function ($url, $model) {
                    $url=['ticket-transaction/print','id' => $model->id];
                    return Html::a('<span class="glyphicon glyphicon-print" title="View Details"></span>', $url, ['data-pjax' => 0, 'target' => "_blank"]);


                },

            ]
        ],
    //    'created_at',
    //    'created_by',


    ];


    // the GridView widget (you must use kartik\grid\GridView)
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
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
            'heading' => '<i class="fa fa-bars"></i> MAHESABU YALIYO FUNGWA KWA SIKU',
            'type' => GridView::TYPE_SUCCESS
        ],
        'exportConfig' => [
            GridView::EXCEL => [
                'filename' => Yii::t('app', 'Transportation Fees Details'),
                'showPageSummary' => true,
                'options' => [
                    'title' => 'Custom Title',
                    'subject' => 'PDF export',
                    'keywords' => 'pdf'
                ],

            ],
            GridView::PDF => [
                'filename' => Yii::t('app', 'Transportation Fees Details'),
                'showPageSummary' => true,
                'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

            ],
            GridView::JSON => [
                'filename' => Yii::t('app', 'Transportation Fees Details'),
                'showPageSummary' => true,
                'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

            ],

        ],

    ]);

    ?>
</div>
