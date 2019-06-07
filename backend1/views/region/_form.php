<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Region */
/* @var $form yii\widgets\ActiveForm */
?>
<p style="padding-top: 15px"/>
<center>
    <h3>
        <i class="fa fa-th text-default">
            <strong>FOMU YA MKOA (REGION FORM)</strong>
        </i>
    </h3>
</center>
<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'Enter region name ...']) ?>

    <?php $form->field($model, 'created_at')->textInput(['readOnly'=>true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
