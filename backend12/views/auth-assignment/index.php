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


                            ['class' => 'yii\grid\ActionColumn',
                                'visible' => yii::$app->user->can('removeRole') || yii::$app->user->can('super_admin') ,
                                'header' => 'Actions'
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
