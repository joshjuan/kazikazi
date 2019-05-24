<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Permissions';
?>
<div style="padding-top: 15px"/>
<div class="auth-item-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if (Yii::$app->user->can('super_admin')) { ?>
            <?= Html::a('Add Permission', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            //'type',
            'description:ntext',
            //'rule_name',
            //'data:ntext',
            // 'created_at',
            // 'updated_at',

            [
                    'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'visible'=>Yii::$app->user->can('super_admin'),
            ],
        ],
    ]); ?>

</div>
