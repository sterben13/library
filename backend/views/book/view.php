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
            <div class="panel panel-default">
            <div class="panel-heading"><h3>Información</h3></div>
            <div class="panel-body">
        
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
                        'label' => 'Ejemplares',
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
                <div class="btn-group ">
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
        </div>
        </div>
        <div class="col-sm-5">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Portada</h3></div>
                <div class="panel-body">
                    <figure class="img-container"  style="height: 250px;">
                       <?= Html::img($model->book_cover) ?>
                    </figure>
                </div>
            </div>
            </div>
    </div>
        
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Resumen</h3></div>
              <div class="panel-body abstract-container"><p class="lead"><?= $model->book_abstract?></p></div>
            </div>
        </div>
    </div>
</div>
