<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Region */

$this->title = '  ';
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="region-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
