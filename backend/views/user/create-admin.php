<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', ' ') . Yii::t('app', 'User');
?>
<div class="user-create">

    <?= $this->render('_form_admin', [
        'model' => $model,
    ]) ?>

</div>
