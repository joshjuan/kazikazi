<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DayAmountSetup */

$this->title = Yii::t('app', 'Update Day Amount Setup: {name}', [
    'name' => $model->amount,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Day Amount Setups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="day-amount-setup-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
