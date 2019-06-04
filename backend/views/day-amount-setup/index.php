<?php

use nickdenry\grid\FilterContentActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DayAmountSetupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Day Amount Setups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="day-amount-setup-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'amount',
            'created_at',
            'created_by',

            [
                'class' => FilterContentActionColumn::className(),
                'header' => 'Actions',
               // 'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('deleteStreet') || Yii::$app->user->can('updateMunicipal') || Yii::$app->user->can('viewStreet'),
                // Set custom classes
                'buttonAdditionalOptions' => [
                    'view' => ['class' => 'btn btn-sm btn-primary'],
                    'update' => ['class' => 'btn btn-default btn-sm'],
                    'delete' => ['class' => 'btn btn-danger btn-sm'],
                ],

                // Add your own filterContent
            ]
        ],
    ]); ?>
</div>
