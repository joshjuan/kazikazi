<?php

use kartik\dynagrid\DynaGrid;
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
    <?php

    $this->registerJs(' 
    setInterval(function(){  
         $.pjax.reload({container:"YOUR_PJAX_CONTAINER_ID"});
    }, 10000);', \yii\web\VIEW::POS_HEAD);
    ?>

    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'TICKET PRINTED',
        ],
        'C' => [
            'content' => 'ALL TICKET PRINTED TRANSACTIONS ',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'color' => '#333333'
        ],
        'R' => [
            'content' => 'receipts:' . date('Y-m-d'),
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
    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],

        [
            'attribute' => 'receipt_no',
        ],
        [
            'attribute' => 'ref_no',
        ],
        [
            'attribute' => 'car_no',

        ],
        [
            'attribute' => 'work_area',
            'value' => function ($model) {
                if ($model->workArea->name != '') {
                    return Html::a($model->workArea->name);
                } else {
                    return '';
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\WorkArea::find()->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => '-- Select --'],
            'format' => 'raw'
        ],

        [
            'label' => 'Clerk',
            'attribute' => 'user',
        //    'vAlign' => 'middle',
         //   'width' => '80px',
            'value' => function ($model) {
                if ($model->user0->name != '') {
                    return Html::a($model->user0->name);
                } else {
                    return '';
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\User::find()->where(['user_type'=>\backend\models\User::CLERK])->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => '-- Select --'],
            'format' => 'raw'
        ],


        //   'status',
        [
            'attribute' => 'create_at',
          //  'width' => '180px',
            'pageSummary' => 'JUMLA',
        ],
        [
            'attribute' => 'amount',
            'format' => ['decimal', 2],
            'pageSummary' => true,
            'footer' => false,

        ],


    ];
    DynaGrid::begin([
        //'dataProvider'=> $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'theme' => 'panel-info',
        'showPersonalize' => true,
        'storage' => 'session',
        'gridOptions' => [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'striped' => true,
            'showPageSummary' => true,
            'hover' => true,

            'toolbar' => [

                ['content' => '{dynagridFilter}{dynagridSort}{dynagrid}'],
                '{export}',
            ],
            'export' => [
                'fontAwesome' => true
            ],
            'pjaxSettings' => [
                'neverTimeout' => true,
                // 'beforeGrid'=>'My fancy content before.',
                //'afterGrid'=>'My fancy content after.',
            ],
            'panel' => [
                'type' => GridView::TYPE_INFO,
                'heading' => '<strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> LIST OF TICKET PRINTED TRANSACTIONS </strong>',
                // 'before' => '<span class="text text-red"> *Eligible*</span>'
            ],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],
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
                    'filename' => Yii::t('kvgrid', 'RECEIPT TRANSACTIONS'),
                    'options' => ['title' => 'Receipts'],
                ],
            ],
        ],
        'options' => ['id' => 'dynagrid-1'] // a unique identifier is important
    ]);


    DynaGrid::end();
    ?>


    <style>
        .truncate {
            max-width: 150px !important;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .truncate:hover {
            overflow: visible;
            white-space: normal;
            width: auto;
        }
    </style>
</div>

