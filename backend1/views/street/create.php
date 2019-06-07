<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Street */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Streets', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Create Street';
?>
<div class="street-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
