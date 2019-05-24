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
$this->params['breadcrumbs'][] = 'Clerk Denis';
?>
<p style="padding-top: 10px"/>
<div class="clerk-deni-index">


    <p>
        <?php if (Yii::$app->user->can('super_admin1')) { ?>
            <?= Html::a('Create Clerk Deni', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        //  'id',
        [
            'attribute' => 'amount_date',
         //   'width' => '180px',
        ],

        [
            'label' => 'Clerk',
            'attribute' => 'name',
            'vAlign' => 'middle',
            'pageSummary' => 'JUMLA',
           // 'width' => '180px',
            'value' =>'user0.name',
            'filterType' => GridView::FILTER_SELECT2,

            'filter' => ArrayHelper::map(\backend\models\User::find()->where(['user_type'=>\backend\models\User::CLERK])->asArray()->all(), 'id', 'username'),

            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => '-- Select Clerk Name --'],
            'format' => 'raw'
        ],

        [
            'attribute' => 'collected_amount',
          //  'width' => '180px',
            'pageSummary' => true,
            'format' => ['decimal', 2],

        ],
        [
            'attribute' => 'submitted_amount',
          //  'width' => '180px',

            'pageSummary' => true,
            'format' => ['decimal', 2],

        ],


        [
            'attribute' => 'deni',
           // 'width' => '180px',
            'format' => ['decimal', 2],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'status',
            'width' => '160px',

            'value' => function ($model) {
                if ($model->status == \backend\models\ClerkDeni::COMPLETE) {

                    return 'COMPLETE';
                } elseif ($model->status == \backend\models\ClerkDeni::NOT_COMPLETE) {
                    return 'NOT COMPLETE';
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => backend\models\ClerkDeni::getStatus(),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => '-- Select Status --'],

        ],
        'created_at',
        'created_by',


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
            'heading' => '<i class="fa fa-bars"></i> MAHESABU YA SUPERVISOR YALIYO FUNGWA KWA SIKU',
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