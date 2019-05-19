<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkArea */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Work Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-area-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
