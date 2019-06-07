<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Municipal */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Municipals', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Municipal';
?>
<div class="municipal-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
