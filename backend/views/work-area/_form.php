<?php

use backend\models\District;
use backend\models\Municipal;
use backend\models\Region;
use backend\models\Street;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkArea */
/* @var $form yii\widgets\ActiveForm */
?>
<p style="padding-top: 15px"/>
<center>
    <h3>
        <i class="fa fa-th text-default">
            <strong> WORK AREA FORM</strong>
        </i>
    </h3>
</center>
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="work-area-form">

            <?php $form = ActiveForm::begin(); ?>
            <div class="box-body table-responsive">
                <div class="col-sm-12 no-padding">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'Enter work area name ...']) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'placeholder'=>'Enter amount ( 0.00 ) ...']) ?>
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
                </div>
                <div class="col-sm-12 no-padding">
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
                    <div class="col-sm-4">
                        <?= $form->field($model, 'municipal')->widget(Select2::classname(), [
                            'data' => Municipal::getMunicipal(),
                            'options' => ['placeholder' => 'Choose Municipal'],
                            'pluginOptions' => [
                                'allowClear' => true,

                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'street')->widget(Select2::classname(), [
                            'data' => Street::getStreet(),
                            'options' => ['placeholder' => 'Choose Street'],
                            'pluginOptions' => [
                                'allowClear' => true,

                            ],
                        ]);
                        ?>
                    </div>
                </div>

                <?php $form->field($model, 'created_by')->textInput(['maxlength' => true, 'readOnly' => true]) ?>

                <?php $form->field($model, 'created_at')->textInput(['readOnly' => true]) ?>

                <div class="col-xs-4 col-xs-8" style="padding-left: 30px; padding-bottom: 15px">
                    <?= Html::submitButton('<i class="fa fa-location-arrow"></i> Submit', ['class' => 'btn btn-success', 'icon' => 'user']) ?>

                    <?= Html::a(Yii::t('app', '<i class="fa fa-close"></i> Cancel'), ['index'], ['class' => 'btn btn-warning']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
</div>
</div>