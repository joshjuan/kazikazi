<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClerkDeni */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clerk-deni-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'collected_amount')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'submitted_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deni')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?php
    echo '<label>Tarehe</label>';
    echo DatePicker::widget([
        'model' => $model,
        'attribute' => 'amount_date',
        'pluginOptions' => [
            'format' => 'yyyy-m-dd',
            'todayHighlight' => true
        ]
    ]);
    ?>

<br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
