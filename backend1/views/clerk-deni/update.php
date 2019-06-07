<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ClerkDeni */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Clerk Denis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clerk-deni-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
