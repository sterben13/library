<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\AuthItem;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Libros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?php
        //Html::encode($this->title) 
    ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(Yii::$app->user->can(AuthItem::CREATE_BOOK)): ?>
    
    <p>
        <?= Html::a('Registrar un Libro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php endif?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //substr($string, $start)
            //'book_id',
            'book_isbn',
            'book_title',
            'book_author',
            //'book_abstract',
            // 'book_cover',
            'book_editorial',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'options'=>[
            'style'=>'background:white'
        ]
    ]); ?>
</div>
