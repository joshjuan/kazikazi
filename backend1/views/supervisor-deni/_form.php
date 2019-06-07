<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClerkDeni */
/* @var $form yii\widgets\ActiveForm */
?>

<p style="padding-top: 15px"/>
<center>
    <h3>
        <i class="fa fa-money text-default">
            <strong> FORM YA KUFUNGA MAHESABU YA SUPERVISOR</strong>
        </i>
    </h3>
</center>
<div class="clerk-deni-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-12 no-padding">
        <div class="col-sm-12">
            <?= $form->field($model, 'name')->widget(Select2::classname(), [
                'data' => \backend\models\User::getSupervisorFullName(),
                'options' => ['placeholder' => 'Chagua Supervisor'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
            ]);
            ?>
        </div>
    </div>
    <?= $form->field($model, 'collected_amount')->hiddenInput(['maxlength' => true])->label(false) ?>
    <div class="col-sm-12 no-padding">
        <div class="col-sm-6">
            <?= $form->field($model, 'submitted_amount')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
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
        </div>
    </div>
    <?= $form->field($model, 'deni')->hiddenInput(['maxlength' => true])->label(false) ?>


    <br>

    <div class="col-sm-12 no-padding">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
