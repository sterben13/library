<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CopySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Copies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="copy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Copy', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'copy_id',
            'book_id',
            'copy_edition',
            'copy_language',
            'copy_available',
            // 'copy_state',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
