<?php

use nickdenry\grid\FilterContentActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WorkAreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Work Areas'
?>
<div class="department-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead" style="color: #01214d;font-family: Tahoma"> <i
                        class="fa fa-check-square text-green"></i> PARKING MIS - LIST OF WORK AREA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">

            <?php if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('createWorkArea')) { ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> New work area'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Work Area List'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?php } ?>
        </div>
    </div>
    <hr/>

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            'amount',
            [
                'attribute' => 'region',
                'value' => 'region0.name',
            ],
            [
                'attribute' => 'district',
                'value' => 'district0.name',
            ],
            [
                'attribute' => 'municipal',
                'value' => 'municipal0.name',
            ],

            [
                'attribute' => 'street',
                'value' => 'street0.name',
            ],

            'created_by',
            'created_at',

            [
                'class' => FilterContentActionColumn::className(),
                'header' => 'Actions',
                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('deleteWorkArea') || Yii::$app->user->can('updateWorkArea') || Yii::$app->user->can('viewWorkArea'),
                // Set custom classes
                'buttonAdditionalOptions' => [
                    'view' => ['class' => 'btn btn-sm btn-primary'],
                    'update' => ['class' => 'btn btn-default btn-sm'],
                    'delete' => ['class' => 'btn btn-danger btn-sm'],
                ],

                // Add your own filterContent
            ],
        ],
    ]); ?>
</div>
