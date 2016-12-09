<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'book_isbn')->label('ISBN') ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'book_title')->label('Titulo') ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'book_author')->label('Autor') ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
