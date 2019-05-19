<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkArea */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Work Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Work Area';
?>
<div class="work-area-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
