<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkArea */

$this->title = 'Create Work Area';
$this->params['breadcrumbs'][] = ['label' => 'Work Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-area-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
