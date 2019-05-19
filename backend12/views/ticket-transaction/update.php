<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TicketTransaction */

$this->title = 'Update Ticket Transaction: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ticket Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ticket-transaction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
