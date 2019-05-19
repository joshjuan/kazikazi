<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MobileLogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mobile Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobile-logs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mobile Logs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'imei_no',
            'last_logoin_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
