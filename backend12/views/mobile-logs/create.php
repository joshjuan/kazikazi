<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MobileLogs */

$this->title = 'Create Mobile Logs';
$this->params['breadcrumbs'][] = ['label' => 'Mobile Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobile-logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
