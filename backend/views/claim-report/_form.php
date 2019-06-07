<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClaimReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="claim-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plate_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'upload')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
