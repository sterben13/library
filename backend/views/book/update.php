<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Book */

$this->title = 'Actualización de Libro: ' . $model->book_id;
$this->params['breadcrumbs'][] = ['label' => 'Librería', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->book_isbn, 'url' => ['view', 'isbn' => $model->book_isbn]];
$this->params['breadcrumbs'][] = 'Actualización';
?>
<div class="book-update">

<!-- 	<h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
