<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '');
$this->params['breadcrumbs'][] = 'Users';
?>
<p style="padding-top: 5px"/>
<div class="user-index">
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead" style="color: #01214d;font-family: Tahoma"> <i class="fa fa-th-list text-blue"></i>
               SYSTEM
                USER - CLERKS LIST</strong>
        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-2">
            <?php if (Yii::$app->user->can('admin') || Yii::$app->user->can('super_admin')) { ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-user"></i> New Clerk'), ['clerk-create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Clerk List'), ['clerk'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?php } ?>
        </div>
    </div>
    <hr/>

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'username',
            'mobile',
            //  'email',
            [
                'attribute' => 'role',
                'label' => 'Role Title'
            ],
            [
                'attribute' => 'region',
                'value' => 'region0.name'
            ],
            [
                'attribute' => 'district',
                'value' => 'district0.name'
            ],
            [
                'attribute' => 'municipal',
                'value' => 'municipal0.name'
            ],
            [
                'attribute' => 'street',
                'value' => 'street0.name'
            ],
            [
                'attribute' => 'work_area',
                'value' => 'work.name'
            ],

            [
                'attribute' => 'status',
                'value' => function ($model) {

                    if ($model->status == User::STATUS_ACTIVE) {
                        return 'Active';
                    } elseif ($model->status == User::STATUS_DELETED) {
                        return 'Disabled';
                    }
                }

            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin'),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = ['view', 'id' => $model->id];
                        return Html::a('<span class="fa fa-pencil"></span>', $url, [
                            'title' => 'Update',
                            'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                            'class' => 'btn btn-primary',

                        ]);


                    },


                ]
            ],
        ],
    ]); ?>

</div>
