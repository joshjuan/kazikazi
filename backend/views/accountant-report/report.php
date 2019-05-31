<?php

use backend\models\ClerkDeni;
use backend\models\ClerkDeniSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountantReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accountant Reports';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clerk-deni-index" style="padding-top: 10px">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'RIPOTI YA MAHESABU',
        ],
        'C' => [
            'content' => 'MAHESABU YA SUPERVISOR YALIFUNGWA KWA SIKU NA ACCOUNTANT',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'color' => '#333333'
        ],
        'R' => [
            'content' => 'receipts:' . date('Y-m-d H:i:s'),
        ],
        'line' => true,
    ];

    $pdfFooter = [
        'L' => [
            'content' => '&copy; PARKING',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'C' => [
            'content' => '',
        ],
        'R' => [
            //'content' => 'RIGHT CONTENT (FOOTER)',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'line' => true,
    ];
    ?>
    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],

        [
            'attribute' => 'collected_date',
          //  'label' => 'Tarehe',
        ],
        [
            'attribute' => 'collected_amount',
            //  'width' => '180px',
            'pageSummary' => true,
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'submitted_amount',
            'pageSummary' => true,
            'format' => ['decimal', 2],
        ],
        [
            'attribute' => 'difference',
            'visible' => yii::$app->user->can('super_admin') || yii::$app->user->can('createAccountantMahesabuModule'),
            'format' => ['decimal', 2],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'report_status',
            'label' => 'Report status',
            'value' => function ($model) {
                if ($model->report_status == \backend\models\SupervisorDeni::OPEN) {
                    return 'OPEN';
                } elseif ($model->report_status == \backend\models\SupervisorDeni::CLOSED) {
                    return 'CLOSED';
                } else {
                    return '';
                }
            }
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
            'class' => 'kartik\grid\ActionColumn',
            'header' => 'Actions',
            'visible' => Yii::$app->user->can('accountant') || Yii::$app->user->can('super_admin')|| Yii::$app->user->can('admin'),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    if ($model->report_status == \backend\models\SupervisorDeni::OPEN) {
                        $url = ['view', 'id' => $model->id];
                        return Html::a('<span class="fa fa-upload"></span>', $url, [
                            'title' => 'View',
                            'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                            'class' => 'btn btn-info',

                        ]);


                    }
                },

            ]
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
        //'created_at',
        //'created_by',

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
      //  'floatHeader' => false,
        'floatHeaderOptions' => ['scrollingTop' => true],
        'showPageSummary' => true,
        'panel' => [
            'heading' => '<i class="fa fa-bars"></i> MAHESABU YA JUMLA YALIYOFUNGA KWA SIKU NA ACCOUNTANT',
            'type' => GridView::TYPE_SUCCESS
        ],
        'exportConfig' => [
            GridView::PDF => [
                'label' => Yii::t('kvgrid', 'PDF'),
                //'icon' => $isFa ? 'file-pdf-o' : 'floppy-disk',
                'iconOptions' => ['class' => 'text-danger'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'RECEIPT TRANSACTIONS'),
                'alertMsg' => Yii::t('kvgrid', 'The PDF export file will be generated for download.'),
                'options' => ['title' => Yii::t('kvgrid', 'Portable Document Format')],
                'mime' => 'application/pdf',
                'config' => [
                    'mode' => 'c',
                    'format' => 'A4-L',
                    'destination' => 'D',
                    'marginTop' => 20,
                    'marginBottom' => 20,
                    'cssInline' => '.kv-wrap{padding:20px;}' .
                        '.kv-align-center{text-align:center;}' .
                        '.kv-align-left{text-align:left;}' .
                        '.kv-align-right{text-align:right;}' .
                        '.kv-align-top{vertical-align:top!important;}' .
                        '.kv-align-bottom{vertical-align:bottom!important;}' .
                        '.kv-align-middle{vertical-align:middle!important;}' .
                        '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',

                    'methods' => [
                        'SetHeader' => [
                            ['odd' => $pdfHeader, 'even' => $pdfHeader]
                        ],
                        'SetFooter' => [
                            ['odd' => $pdfFooter, 'even' => $pdfFooter]
                        ],
                    ],

                    'options' => [
                        'title' => 'PDF export generated',
                        'subject' => Yii::t('kvgrid', 'PDF export generated by kartik-v/yii2-grid extension'),
                        'keywords' => Yii::t('kvgrid', 'krajee, grid, export, yii2-grid, pdf')
                    ],
                    'contentBefore' => '',
                    'contentAfter' => ''
                ]
            ],
            GridView::CSV => [
                'label' => 'CSV',
                'filename' => Yii::t('kvgrid', 'RIPOTI YA MAHESABU'),
                'options' => ['title' => 'Receipts'],
            ],
        ],

    ]);

    ?>
</div>

