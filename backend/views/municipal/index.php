<?php

use nickdenry\grid\FilterContentActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MunicipalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Municipals';
?>
<div class="department-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead" style="color: #01214d;font-family: Tahoma"> <i
                        class="fa fa-check-square text-green"></i> PARKING MIS - LIST OF SHEHIA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">

            <?php if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('createMunicipal')) { ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> New Shehia'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Sheshia List'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
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
            [
                'attribute' => 'region',
                'value' => 'region0.name',
            ],
            [
                'attribute' => 'district',
                'value' => 'district0.name',
            ],

            'created_at',
            'created_by',

            [
                'class' => FilterContentActionColumn::className(),
                'header' => 'Actions',
                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('deleteMunicipal') || Yii::$app->user->can('updateMunicipal') || Yii::$app->user->can('viewMunicipal'),
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