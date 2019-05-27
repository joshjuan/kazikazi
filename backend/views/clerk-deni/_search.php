<?php

use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TicketTransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
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
                            'options'=>['placeholder'=>'Date From']
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
                    <div class="col-md-4">
                        <?=  $form->field($model, 'created_by')->dropDownList(\backend\models\User::getSupervisorFullName(),
                            ['prompt' => Yii::t('app', '--Select Supervisor--')])->label(false);
                        ?>
                    </div>

                        <div class="col-md-3">
                            <?=  $form->field($model, 'name')->dropDownList(\backend\models\User::getClerk(),
                                ['prompt' => Yii::t('app', '--Select Clerk--')])->label(false);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=  $form->field($model, 'status')->dropDownList(\backend\models\ClerkDeni::getStatus(),
                                ['prompt' => Yii::t('app', '--Select Status--')])->label(false);
                            ?>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
                        </div>
                    </div>
                </div>



                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
