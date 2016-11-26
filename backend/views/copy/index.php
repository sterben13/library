<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Book;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CopySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Copias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="copy-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('REGISTRAR EJEMPLAR', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            
            'copy_id',
            
            [   
                'attribute'=> 'book_id',
                'value'=>function ($data) {
                    $book = Book::find()->where(['book_id' => $data->book_id])->one();
                    
                    if(strlen($book->book_title)<50){
                        return htmlspecialchars($book->book_title);
                    }else{
                        $book = substr($book->book_title, 0, 50);
                        return htmlspecialchars($book);
                    }
                },
            ],
                        'copy_edition',
            [
                'attribute'=>'copy_available',
                'value'=> function ($data){
                    if($data->copy_available == 0){
                        return "Disponible";
                    }else{
                        return "Ocupado";
                    }
                }
            ],
                        
            'copy_language',
            
            'copy_state',
                        
            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
        'options'=>[
            'style'=>'background:white;'
        ]
    ]); ?>
</div>
