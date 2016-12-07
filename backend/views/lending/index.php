<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;
use backend\models\Book;
use \backend\models\Copy;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LendingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Préstamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lending-index">

    
    

    <p>
        <?= Html::a('REGISTRAR PRÉSTAMO', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'value' => function ($model){
                    $user = User::find()->where(['user_id'=>$model->user_id])->one();
                    return $user['user_names']
                            .' '.$user['user_lastname']
                            .' '.$user['user_snd_lastname'];
                },
                'label' => "Nombre del Usuario"
            ],
            [
                'attribute' => 'copy_id',
                'value' => function ($model){
                    $copy = Copy::find()->where(['copy_id'=>$model->copy_id])->one();
                    $book = Book::find()->where(['book_id'=>$copy->book_id])->one();
                    return $book->book_title;
                },
                'label' => 'Titulo del Ejemplar'
            ],
            'copy_id',
            [
                'attribute'=>'lend_auth_at',
                'value'=> function ($model){
                    Yii::$app->formatter->locale = 'es-mx';
                    return Yii::$app->formatter->asDate($model->lend_auth_at);
                }
            ],
            [
                'attribute'=>'lend_return_at',
                'value'=> function ($model){
                    Yii::$app->formatter->locale = 'es-mx';
                    return Yii::$app->formatter->asDate($model->lend_return_at);
                }
            ],
            [
                'attribute'=>'lend_return_real',
                'value'=> function ($model){
                    Yii::$app->formatter->locale = 'es-mx';
                    return Yii::$app->formatter->asDate($model->lend_return_real);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'options'=>[
            'style'=>'background:white;'
        ]
    ]); ?>
</div>
