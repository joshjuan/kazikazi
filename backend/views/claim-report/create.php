<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ClaimReport */

$this->title = 'Create Claim Report';
$this->params['breadcrumbs'][] = ['label' => 'Claim Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
