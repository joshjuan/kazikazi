<<<<<<< HEAD
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->name .' login details';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<hr>

<div class="user-view">
    <div class="row">
        <div class="col-md-8">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                'name',
            'username',
            'mobile',
            'email',
            'role',
            [
                'attribute' => 'status',
                'value' => $model->statusLabel,
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    </div>

    <div class="col-md-4">
    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
   
   <?php if(Yii::$app->user->can('super_admin')){ ?>
    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
    ]) ?>
        <?php } ?>
    </div>
    </div>
</div>
=======
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->name .' login details';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<hr>

<div class="user-view">
    <div class="row">
        <div class="col-md-8">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                'name',
            'username',
            'mobile',
            'email',
            'role',
/*            [
                'attribute' => 'region',
                'value' => 'region0.name',
            ],
            [
                'attribute' => 'district',
                'value' => 'district0.name',
            ],
            [
                'attribute' => 'municipal',
                'value' => 'municipal0.name',
            ],
            [
                'attribute' => 'street',
                'value' => 'street.name',
            ],
            [
                'attribute' => 'work_area',
                'value' => 'work_area0.name',
            ],*/
            [
                'attribute' => 'status',
                'value' => $model->statusLabel,
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    </div>

    <div class="col-md-4">
    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
    ]) ?>
    </div>
    </div>
</div>
>>>>>>> 4a9cae9c855817ff6b5748ce3c6b3d72d3c4654d
