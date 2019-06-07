<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkArea */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Work Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="work-area-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'name',
            'amount',
           [
                   'attribute'=>'region',
                   'value'=>$model->region0->name,
            ],
            [
                   'attribute'=>'district',
                   'value'=>$model->district0->name,
            ],
            [
                   'attribute'=>'municipal',
                   'value'=>$model->municipal0->name,
            ],
            [
                   'attribute'=>'street',
                   'value'=>$model->street0->name,
            ],


            'created_by',
            'created_at',
        ],
    ]) ?>

    <p>
        <?php if (Yii::$app->user->can('updateWorkArea') || Yii::$app->user->can('super_admin')) { ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } ?>

        <?= Html::a('Cancel', ['index', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>


        <?php if (Yii::$app->user->can('deleteWorkArea') || Yii::$app->user->can('super_admin')) { ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

</div>
