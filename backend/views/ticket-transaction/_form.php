<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TicketTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'begin_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'region')->textInput() ?>

    <?= $form->field($model, 'district')->textInput() ?>

    <?= $form->field($model, 'municipal')->textInput() ?>

    <?= $form->field($model, 'street')->textInput() ?>

    <?= $form->field($model, 'work_area')->textInput() ?>

    <?= $form->field($model, 'receipt_no')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'car_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
