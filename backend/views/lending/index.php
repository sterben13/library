<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LendingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lendings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lending-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lending', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'copy_id',
            'lend_auth_at',
            'lend_return_at',
            'lend_return_real',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
