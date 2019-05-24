<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Municipal */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Municipals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="municipal-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',


            [
                'attribute'=>'region',
                'value'=>$model->region0->name,
            ],
            [
                'attribute'=>'district',
                'value'=>$model->district0->name,
            ],



            'created_at',
            'created_by',
        ],
    ]) ?>

    <p>
        <?php if (Yii::$app->user->can('updateMunicipal') || Yii::$app->user->can('super_admin')) { ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } ?>

        <?= Html::a('Cancel', ['index', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>


        <?php if (Yii::$app->user->can('deleteMunicipal') || Yii::$app->user->can('super_admin')) { ?>
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
