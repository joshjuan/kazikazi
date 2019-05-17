<?php

use backend\models\AuthItem;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row">
    <div class="box-body table-responsive">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Role Assignment form</h4>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php
                                        echo $form->field($model, 'user_id')->widget(Select2::classname(), [
                                            'data' => \yii\helpers\ArrayHelper::map(\backend\models\User::find()->all(), 'id', 'username'),
                                            'language' => 'en',
                                            'options' => ['placeholder' => '-- Select User Name --'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                        ?>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php
                                        echo $form->field($model, 'item_name')->widget(Select2::classname(), [
                                            'data' => \yii\helpers\ArrayHelper::map(\backend\models\AuthItem::find()->where(['type'=> 1])->all(),'name','name'),
                                            'language' => 'en',
                                            'options' => ['placeholder' => '-- Select User Name --'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>

                            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
