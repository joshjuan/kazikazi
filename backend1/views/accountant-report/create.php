<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountantReport */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Accountant Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Accountant Reports';
?>
<div class="accountant-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
