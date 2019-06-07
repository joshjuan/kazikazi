<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DayAmountSetup */

$this->title = Yii::t('app', 'Create Day Amount Setup');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Day Amount Setups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="day-amount-setup-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
