<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountantReport */

$this->title ='Mahesabu ya tarehe '. $model->created_at;
$this->params['breadcrumbs'][] = ['label' => 'Accountant Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-xs-12" style="padding-top: 20px">
    <div class="box box-primary view-item">
        <div class="product-type-view">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    'collected_amount',
                    'submitted_amount',
                    'difference',
                    'collected_date',
                 //   'created_at',
                    'created_by',
                 //   'updated_at',
                 //   'updated_by',
                    'receipt_no',
                    'uploaded_receipt',
                    [
                        'attribute' => 'report_status',
                        'label' => 'Report status',
                        'value' => function ($model) {
                            if ($model->report_status == \backend\models\SupervisorDeni::OPEN) {
                                return 'OPEN';
                            } elseif ($model->report_status == \backend\models\SupervisorDeni::CLOSED) {
                                return 'CLOSED';
                            } else {
                                return '';
                            }
                        }
                    ],
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

                <?php $form = ActiveForm::begin(['action' => ['accountant-report/upload-slip','id'=>$model->id]]); ?>

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
