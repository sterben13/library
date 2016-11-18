<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Book */

$this->title = $model->book_title;
$this->params['breadcrumbs'][] = ['label' => 'Libros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->book_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->book_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

   

    <div class="row">
        <div class="col-sm-5">
             <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'book_isbn',
            'book_title',
            'book_author',
            'book_editorial',
            [
                'label' => 'Portada',
                'format'=>'raw',
                'value' => Html::a('Archivo', $model->book_cover), 
            ],
        ],
    ]) ?>
        </div>
        <div class="col-xs-12 col-sm-7">
            <h3>Resumen</h3>
            <p class="lead well"><?= $model->book_abstract?></p>
        </div>
    </div>

</div>
