<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClaimReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Claim Reports';
?>

<p style="padding-top: 15px"/>
<div style="text-align: center;">
    <h3>
        <i class="fa fa-folder-open text-default">
            <strong> RIPOTI YA MALALAMIKO</strong>
        </i>
    </h3>
</div>
<div class="claim-report-index" ">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'plate_no',
            'upload',
            'comment',
            'created_at',
            'created_by',


        ],
    ]); ?>
</div>
