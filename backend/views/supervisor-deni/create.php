<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ClerkDeni */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Clerk Denis', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Clerk Deni';
?>
<div class="clerk-deni-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
