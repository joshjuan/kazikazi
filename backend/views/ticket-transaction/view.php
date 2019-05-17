<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TicketTransaction */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ticket Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ticket-transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ref_no',
            'begin_time',
            'end_time',
            'region',
            'district',
            'municipal',
            'street',
            'work_area',
            'receipt_no',
            'amount',
            'car_no',
            'user',
            'status',
            'create_at',
            'created_by',
        ],
    ]) ?>

</div>
