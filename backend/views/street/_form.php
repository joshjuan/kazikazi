<?php

use backend\models\District;
use backend\models\Municipal;
use backend\models\Region;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Street */
/* @var $form yii\widgets\ActiveForm */
?>

<p style="padding-top: 15px"/>
<center>
    <h3>
        <i class="fa fa-th text-default">
            <strong> ZONE FORM</strong>
        </i>
    </h3>
</center>
<div class="municipal-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-12 no-padding">
        <div class="col-sm-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Enter street name ...']) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'region')->widget(Select2::classname(), [
                'data' => Region::getRegion(),
                'options' => ['placeholder' => 'Choose Region'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
            ]);
            ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'district')->widget(Select2::classname(), [
                'data' => District::getDistrict(),
                'options' => ['placeholder' => 'Choose District'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
            ]);
            ?>
        </div>
    </div>
    <div class="col-sm-12 no-padding">
        <div class="col-sm-12">
            <?= $form->field($model, 'municipal')->widget(Select2::classname(), [
                'data' => Municipal::getMunicipal(),
                'options' => ['placeholder' => 'Choose Municipal'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
            ]);
            ?>
        </div>
    </div>

    <?php $form->field($model, 'created_at')->textInput(['readOnly'=>true]) ?>

    <?php $form->field($model, 'created_by')->textInput(['maxlength' => true,'readOnly'=>true]) ?>

    <div class="form-group col-xs-12 col-sm-6 col-lg-4" style="padding-top: 15px">
        <div class="col-xs-4 col-xs-8">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-info']) ?>
        </div>
        <div class="col-xs-4 col-xs-8">
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
