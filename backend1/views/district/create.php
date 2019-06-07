<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\District */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Districts', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'District';
?>
<div class="district-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
