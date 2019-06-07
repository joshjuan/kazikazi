<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Street */

$this->title = ' ';
$this->params['breadcrumbs'][] = ['label' => 'Streets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="street-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
