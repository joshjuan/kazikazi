<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Municipal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="municipal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region')->widget(Select2::classname(), [
        'data' => \backend\models\Region::getRegion(),
        'options' => ['placeholder' => 'Choose Region'],
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <?= $form->field($model, 'district')->widget(Select2::classname(), [
        'data' => \backend\models\District::getDistrict(),
        'options' => ['placeholder' => 'Choose District'],
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
