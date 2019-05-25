<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ClerkDeni */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Supervisor Deni', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update Supervisor Deni'

?>


<div class="col-xs-12" style="padding-top: 20px">
    <div class="box box-primary view-item">
        <div class="product-type-view">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'name',
                       'value'=>function($model){
                        return $model->user0->name;
                       },
                    ],
                    'collected_amount',
                    'submitted_amount',
                    'deni',
                    'amount_date',
                    'created_at',
                    'created_by',
                ],
            ]) ?>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
            <div class="col-xs-4 left-padding">
                <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-block btn-warning']) ?>
            </div>
            <?php
            Modal::begin([
                'header' => '<h3 class="text text-primary">UPLOAD BANK PAY SLIP</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i> Upload File', 'class' => 'btn btn-info',],
                'size' => Modal::SIZE_DEFAULT,
                'options' => ['class' => 'slide', 'id' => 'modal-2'],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form" style="margin-left: 10px">

                <?php $form = ActiveForm::begin(['action' => ['supervisor-deni/upload-slip','id'=>$model->id]]); ?>

                <?= $form->field($model, 'file')->fileInput() ?>
                <?= $form->field($model, 'receipt_no')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn b btn-success' : 'btn  btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <?php
            Modal::end();
            ?>
        </div>
    </div>
</div>