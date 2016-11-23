<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\Copy;

/* @var $this yii\web\View */
/* @var $model backend\models\Book */

$this->title = $model->book_title;
$this->params['breadcrumbs'][] = ['label' => 'Libros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

   <!--  <h1><?= Html::encode($this->title) ?></h1> -->


    <div class="row">
        <div class="col-sm-7">

            <h3>Datos</h3>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'book_isbn',
                    'book_title',
                    'book_author',
                    'book_editorial',
                    // [
                    //     'label' => 'Portada',
                    //     'format'=>'raw',
                    //     'value' => Html::a('Archivo', $model->book_cover), 
                    // ],
                    [
                        'label' => 'Copias',
                        'value' => Copy::find()->where(['book_id' => $model->book_id])->count() . '', 
                    ],
                     [
                        'label' => 'Categorías',
                        'format' => 'raw',
                        'value' => $model->getCategoriesAsHtml(), 
                    ]
                ],
            ])?>
            <p>
                <div class="btn-group btn-group-justified">
                    <?= Html::a('Actualizar', ['update', 'id' => $model->book_id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->book_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])?>
                </div>
            </p>
        </div>
        <div class="col-xs-12 col-sm-5">
            <h3>Portada</h3>
            <figure class="img-container"  style="height: 240px;">
               <?= Html::img($model->book_cover) ?>
            </figure>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3>Resumen</h3>
            <div class="panel panel-default">
              <div class="panel-body abstract-container"><p class="lead"><?= $model->book_abstract?></p></div>
            </div>
           <!--  <p class="lead well abstract-container"><?= $model->book_abstract?></p> -->
        </div>
    </div>
</div>
