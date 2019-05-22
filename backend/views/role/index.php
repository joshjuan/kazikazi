<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = Yii::t('app', 'Roles');
?>
<p style="padding-top: 20px"/>
<div class="admin-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if (Yii::$app->user->can('super_admin')) { ?>
            <?= Html::a(Yii::t('app', 'Create ') . Yii::t('app', 'Role'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?= \fedemotta\datatables\DataTables::widget([

        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
            ],
            'description',
            [

                'class' => 'yii\grid\ActionColumn', 'header' => 'Actions',
                'visible'=>Yii::$app->user->can('admin')||Yii::$app->user->can('super_admin'),
                'urlCreator' => function ($action, $model, $key, $index) {
                    $link = '#';
                    switch ($action) {
                        case 'view':
                            $link = Yii::$app->getUrlManager()->createUrl(['role/view', 'name' => $model->name]);
                            break;
                        case 'update':

                            $link = Yii::$app->getUrlManager()->createUrl(['role/update', 'name' => $model->name]);
                            break;
                        case 'delete':
                            $link = Yii::$app->getUrlManager()->createUrl(['role/delete', 'name' => $model->name]);
                            break;
                    }
                    return $link;
                },

            ],

        ],
    ]); ?>

</div>
