<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\District */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Districts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
\yii\web\YiiAsset::register($this);
?>
<p style="padding-top: 20px"/>
<div class="district-view">



    <p>
        <?php if (Yii::$app->user->can('updateDistrict') || Yii::$app->user->can('super_admin')) { ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } ?>

        <?= Html::a('Cancel', ['index', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>


        <?php if (Yii::$app->user->can('deleteDistrict') || Yii::$app->user->can('super_admin')) { ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'name',
            [
                    'attribute'=>'region',
            'value'=>$model->region0->name,
            ],
            'create_at',
            'created_by',
        ],
    ]) ?>

</div>
