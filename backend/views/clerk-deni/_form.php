<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClerkDeni */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clerk-deni-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'collected_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'submitted_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_date')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
