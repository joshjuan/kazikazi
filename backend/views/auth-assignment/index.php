<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Auth Assignments';
?>
<p style="padding-top: 10px"/>
<div id="main_content">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">List of users Roles</h4>
                </div>
                <p style="padding-top: 20px;padding-left: 10px">
                    <?php //echo Html::a('Add Assignment', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <div class="panel-body">
                    <div class="box-body table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'summary' => '',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'user_id',
                                'value' => function ($model) {
                                    if ($model->user != null) {
                                        return $model->user->username;
                                    } else {
                                        return;
                                    }
                                }

                            ],
                            'item_name',
                            // 'created_at',


                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'visible' => yii::$app->user->can('removeRole') || yii::$app->user->can('super_admin') ,
                                'template' => '{view} {delete}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        $url = ['update', 'item_name' => $model->item_name, 'user_id' => $model->user_id];
                                        return Html::a('<span class="fa fa-arrow-right"></span>', $url, [
                                            'title' => 'Update',
                                            'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                            'class' => 'btn btn-primary',

                                        ]);


                                    },
                                    'delete' => function ($url, $model) {
                                        $url = ['delete', 'item_name' => $model->item_name, 'user_id' => $model->user_id];
                                        return Html::a('<span class="fa fa-trash"></span>', $url, [
                                            'title' => 'Delete',
                                            'class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this item?',
                                                'method' => 'post',
                                            ]

                                        ]);


                                    },


                                ]
                            ],

                        ],
                    ]); ?>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
