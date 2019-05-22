<?php

use backend\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form \yii\widgets\ActiveForm */


$countries = ArrayHelper::map(\backend\models\Region::find()->asArray()->all(), 'id', 'name');
$cities = ArrayHelper::map(\backend\models\District::find()->asArray()->all(), 'id', 'name');
?>
<div class="employee-loans-index" style="padding-top: 25px">
    <div class="panel panel-default">
        <div class="user-index" style="padding-top: 40px;padding-left: 10px">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                    'id' => 'dynamic-form'
                ],
            ]); ?>
            <h2 class="page-header">
                <i class="fa fa-list"></i> <?php echo Yii::t('app', 'Staff Details'); ?>
            </h2>
            <div class="box-body">

                <div class="col-xs-12 col-lg-12 col-sm-12">
                    <div class="col-sm-12 no-padding">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">

                            <?= $form->field($model, 'region')->dropDownList(
                                $countries,
                                [
                                    'prompt' => 'Select Region',
                                    'onchange' => '
	                                    $.post("index.php?r=user/region-list&id="+$(this).val(), function( data ) {
	                                   $( "select#city" ).html( data );
	                                  });'
                                ]
                            ); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 no-padding">
                        <div class="col-sm-4">
                            <?php echo $form->field($model, 'district')
                                ->dropDownList(
                                    $cities,
                                    [
                                        'prompt' => 'Select District', 'id' => 'city',
                                        'onchange' => '
	                                    $.post("index.php?r=user/district-list&id="+$(this).val(), function( data ) {
	                                   $( "select#city1" ).html( data );
	                                  });'
                                    ]
                                ); ?>

                        </div>
                        <div class="col-sm-4">

                            <?php echo $form->field($model, 'municipal')
                                ->dropDownList(
                                    $cities,
                                    [
                                        'prompt' => 'Select District', 'id' => 'city1'
                                    ]
                                ); ?>

                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'street')->widget(Select2::classname(), [
                                'data' => \backend\models\Street::getStreet(),
                                'options' => ['placeholder' => 'Choose Street'],
                                'pluginOptions' => [
                                    'allowClear' => true,

                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-12 no-padding">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'work_area')->widget(Select2::classname(), [
                                'data' => \backend\models\WorkArea::getWorkArea(),
                                'options' => ['placeholder' => 'Choose work area'],
                                'pluginOptions' => [
                                    'allowClear' => true,

                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="col-sm-12 no-padding">

                        <div class="col-sm-6">
                            <?= $form->field($model, 'role')->dropDownList(\backend\models\User::getArrayRole(), ['prompt' => '-- select Role name --']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'status')->dropDownList(\backend\models\User::getArrayStatus()) ?>
                        </div>
                    </div>
                    <div class="col-sm-12 no-padding">
                        <div class="col-sm-6">

                            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-lg-4">
                        <div class="col-xs-6 col-xs-12">
                            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-info']) ?>
                        </div>
                        <div class="col-xs-6 col-xs-12">
                            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning btn-block']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div><!---./end box-body--->
        </div><!---./end box--->
    </div>
