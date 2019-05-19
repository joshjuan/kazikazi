<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DistrictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Districts';
?>
<p style="padding-top: 10px"/>
<div class="received-cash-index" style="padding-top: 10px">

    <?php Pjax::begin(); ?>
    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],

        'name',
        [
            'attribute' => 'region',
            'value' => 'region0.name',
        ],
        'create_at',
        'created_by',
        [
            'header' => 'Actions',
            'format' => 'raw',
            // 'visible' => Yii::$app->user->can('super_admin') ,
            'value' => function ($data) {

                return
                    Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $data->id], ['title' => 'view', 'class' => 'btn btn-info']) . ' ' .

                    Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $data->id], ['title' => 'edit', 'class' => 'btn btn-info'], [//  Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'id' => $data->id], [
                        'class' => 'btn btn-danger',
                        'data' => ['confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',],]);
            }
        ],

    ];

    // the GridView widget (you must use kartik\grid\GridView)
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'id' => 'grid',
        // 'filename' => 'exported-data_' . date('Y-m-d_H-i-s'),

        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export',

                ], // remove this row from export
            ]
        ],


        'pjax' => true,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,

        'export' => [
            'fontAwesome' => true,
        ],

        // 'floatHeaderOptions' => ['scrollingTop' => true],
        //   'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => '<strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> LIST OF DISTRICTS</strong>',
            // 'before' => '<span class="text text-red"> *Eligible*</span>'
        ],

        'exportConfig' => [
            GridView::EXCEL => [
                'filename' => Yii::t('app', 'Taarifa za Kupokea Pesa'),
                'showPageSummary' => true,
                'options' => [
                    'title' => 'Custom Title',
                    'subject' => 'PDF export',
                    'keywords' => 'pdf'
                ],

            ],
            GridView::PDF => [
                'filename' => Yii::t('app', 'Taarifa za Kupokea Pesa'),
                'showPageSummary' => true,
                'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

            ],
            GridView::JSON => [
                'filename' => Yii::t('app', 'Taarifa za Kupokea Pesa'),
                'showPageSummary' => true,
                'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

            ],

        ],

        'rowOptions' => function ($model) {
            return ['data-id' => $model->id];
        },


    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
