<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DayAmountSetup */

$this->title = $model->amount;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Day Amount Setups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="day-amount-setup-view">


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'id',
            'amount',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>
