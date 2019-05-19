<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Municipal */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Municipals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="municipal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
