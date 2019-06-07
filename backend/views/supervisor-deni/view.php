<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ClerkDeni */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Supervisor Deni', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update Supervisor Deni'

?>


<div class="col-xs-12" style="padding-top: 20px">
    <div class="box box-primary view-item">
        <div class="product-type-view">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'name',
                       'value'=>function($model){
                        return $model->user0->name;
                       },
                    ],
                    'collected_amount',
                    'submitted_amount',
                    'deni',
                    'amount_date',
                    'created_at',
                    'created_by',
                ],
            ]) ?>
        </div>
    </div>
</div>