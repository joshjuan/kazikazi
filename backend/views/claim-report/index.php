<?php

use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClaimReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Claim Reports';
?>

<p style="padding-top: 15px"/>
<div style="text-align: center;">
    <h3>
        <i class="fa fa-folder-open text-default">
            <strong> RIPOTI YA MALALAMIKO</strong>
        </i>
    </h3>
</div>
<div class="claim-report-index" ">


<?php echo $this->render('_search', ['model' => $searchModel]); ?>



<?= DataTables::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        'created_at',
        'plate_no',

        [
            'attribute' => 'comment',
            // 'width' => '400px',
            'contentOptions' => ['class' => 'truncate'],
        ],
        [
            'label' => 'Picha',
            'format' => 'raw',
            // 'width' => '50px',
            'value' => function ($model) {
                if ($model->upload == null) {
                    return 'No attached file';
                } elseif ($model->upload != null) {

                    $basepath = Yii::$app->request->baseUrl . '/document/' . $model->upload;
                    //$path = str_replace($basepath, '', $model->attachment);
                    return Html::a('<i class="fa fa-folder-open text-green"></i>', $basepath, array('target' => '_blank'));


                }
            }
        ],
        [
            'label' => 'Aliyelipoti (Karani)',
            'attribute' => 'created_by',

            'value' => 'userClerk.name',

        ],


    ],
]); ?>


<style>
    .truncate {
        max-width: 150px !important;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .truncate:hover {
        overflow: visible;
        white-space: normal;
        width: auto;
    }
</style>
</div>
