<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ClerkDeni */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Supervisor Deni', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Supervisor Deni';
?>
<div class="clerk-deni-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
