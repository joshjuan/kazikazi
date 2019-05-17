<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MobileLogs */

$this->title = 'Update Mobile Logs: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mobile Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mobile-logs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
