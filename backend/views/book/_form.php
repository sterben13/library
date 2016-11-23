<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\URL;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    
</style>
<div class="book-form container-fluid">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <div class="row">

    <div class="col-xs-12 col-sm-5 col-md-5 img-container">
        <figure>
        <?= 
            Html::img($model->isNewRecord ? Url::to('@web/img/covers/generic-book-cover_e.jpg') :  $model->book_cover,
                [
                    'id' => 'preview-img',
                    'alt' => 'Portada de libro'
                ]);
        ?>
        </figure>
    </div>


    <fieldset class="col-xs-12 col-sm-7 col-md-7 details-container">
    <legend>Datos del Libro</legend>
    <div class="row">   
        <div class="col-sm-6">   
        <?= $form->field($model, 'book_isbn')->textInput(['maxlength' => true, 'pattern' => '[0-9]{13}', 'required' => true]) ?>
        </div>

        <div class="col-sm-6">   
        <?= $form->field($model, 'book_editorial')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <?= $form->field($model, 'book_title')->textInput(['maxlength' => true]) ?>

    <div class="row">   
        <div class="col-sm-10">   
                <?= $form->field($model, 'book_author')->textInput(['maxlength' => true, 'pattern' => "(-?([a-zñ,A-ZÑ].\s)?([A-ZÑ][a-zñ]+)\s?)+([A-ZÑ]([A-ZÑ][a-zñ]+))?"]) ?>

         <?= $form->field($model, 'categories')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Category::find()->all(), 'cat_name', 'cat_name'),
                'options' => ['placeholder' => 'Selecciona una categoría ...', 'multiple' => true, 'required' => true],
                'pluginOptions' => [
                    'tokenSeparators' => [',', ' '],
                    'maximumInputLength' => 10
                ],
            ]);
        ?>
        </div>

    </div>
    <?= $form->field($model, 'coverFile')->fileInput([
        'accept' => 'image/*',
        'onchange' => 'showPreview("#preview-img", this)'
        ]) ?>

     <?= $form->field($model, 'book_abstract')->textarea(['rows' => 6, 'cols' => 50]) ?>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'registrar' : 'actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </fieldset>


    </div>
    
    
    <div class="row">
    <div class="col-xs-12">
       
    </div>
    </div>

   

    <?php ActiveForm::end(); ?>

</div>
