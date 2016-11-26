<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Book;

/* @var $this yii\web\View */
/* @var $model backend\models\Copy */

$this->title = Book::find()->where(['book_id'=>$model->book_id])->one()->book_title;
$this->params['breadcrumbs'][] = ['label' => 'Copias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="copy-view">

    <h1><?php //Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ACTUALIZAR', ['update', 'id' => $model->copy_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ELIMINAR', ['delete', 'id' => $model->copy_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div style="background: white">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'copy_id',
            [       
                'attribute' => 'book_id',
                'value' => Book::find()->where(['book_id'=>$model->book_id])->One()->book_title,
            ],
            'copy_edition',
            'copy_language',
            [
                'attribute'=>'copy_available',
                'value'=> yii\bootstrap\Html::encode($model->copy_available==0?"Disponible":"Ocupado"),
            ]
            ,
            'copy_state',
        ],
    ]) ?>
    </div>
</div>
