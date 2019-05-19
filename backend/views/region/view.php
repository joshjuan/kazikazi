<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Region */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
\yii\web\YiiAsset::register($this);
?>
<p style="padding-top: 10px"/>
<div class="region-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'created_at',
            'created_by',


        ],
    ]) ?>
    <p>
        <?php if (Yii::$app->user->can('updateRegion') || Yii::$app->user->can('super_admin')) { ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } ?>

            <?= Html::a('Cancel', ['index', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>


        <?php if (Yii::$app->user->can('deleteRegion') || Yii::$app->user->can('super_admin')) { ?>
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
