<?php

use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TicketTransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['date-range'],
        'method' => 'get',

    ]);
  //  $model = new \backend\models\TicketTransactionSearch()
    ?>
    <div class="panel panel-warning" style="background: #EEE">
        <div class="panel panel-heading">
            <a data-toggle="collapse" href="#collapse1"> Items Search</a>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel panel-body" style="background: #EEE">
                <div class="row">
                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'date_from')->widget(
                                DatePicker::className(), [
                                // inline too, not bad
                                'inline' => false,
                                // modify template for custom rendering
                                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd',

                                ],
                                'options'=>['placeholder'=>'Date from']
                            ])->label(false);?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'date_to')->widget(
                                DatePicker::className(), [
                                // inline too, not bad
                                'inline' => false,
                                // modify template for custom rendering
                                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd',

                                ],
                                'options'=>['placeholder'=>'Date To']
                            ])->label(false);?>
                        </div>
                        <div class="col-md-3">

                            <?=  $form->field($model, 'region')->dropDownList(\backend\models\Region::getRegion(),
                                ['prompt' => Yii::t('app', '--Select Region--')])->label(false);
                            ?>
                        </div>
                        <div class="col-md-3">

                            <?=  $form->field($model, 'district')->dropDownList(\backend\models\District::getDistrict(),
                                ['prompt' => Yii::t('app', '--Select District--')])->label(false);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">

                            <?=  $form->field($model, 'municipal')->dropDownList(\backend\models\Municipal::getMunicipal(),
                                ['prompt' => Yii::t('app', '--Select Municipal--')])->label(false);
                            ?>
                        </div>
                        <div class="col-md-3">

                            <?=  $form->field($model, 'street')->dropDownList(\backend\models\Street::getStreet(),
                                ['prompt' => Yii::t('app', '--Select street--')])->label(false);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=  $form->field($model, 'work_area')->dropDownList(\backend\models\WorkArea::getWorkArea(),
                                ['prompt' => Yii::t('app', '--Select Work Area--')])->label(false);
                            ?>

                        </div>
                    </div>
                </div>

                <div class="form-group" style="float: right">
                    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
