<?php

use backend\models\Region;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\District */
/* @var $form yii\widgets\ActiveForm */
?>
<p style="padding-top: 15px"/>
<center>
    <h3>
        <i class="fa fa-th text-default">
            <strong> DISTRICT FORM (FOMU YA WILAYA)</strong>
        </i>
    </h3>
</center>
<div class="district-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'Enter district name ...']) ?>

    <?= $form->field($model, 'region')->widget(Select2::classname(), [
        'data' => Region::getRegion(),
        'options' => ['placeholder' => 'Choose Region'],
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    ?>

    <?php $form->field($model, 'create_at')->textInput(['readOnly'=>true]) ?>

    <?php $form->field($model, 'created_by')->textInput(['maxlength' => true,'readOnly'=>true]) ?>

    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
