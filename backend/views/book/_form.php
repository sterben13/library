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

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

    <div class="img-container col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-0 col-md-3 container-fluid">
        <figure>
        <center>
        <?= 
            Html::img($model->isNewRecord ? Url::to('@web/img/covers/generic-book-cover.jpg') :  $model->coverUrl,
                [
                    'id' => 'preview-img',
                    'class' => 'img-responsive',
                    'alt' => 'Portada de libro'
                ]);
        ?>
        </center>
        </figure>
        <?= $form->field($model, 'coverFile')->fileInput([
            'id' => 'image-input',
            'accept' => 'image/*',
            'onchange' => 'showPreview("#preview-img", this);'
            ])->label(false) ?>
    </div>
    <br>

    <div class="col-xs-12 col-sm-8 col-md-9">

    <div class="row">   
        <div class="col-sm-6">   
        <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-6">   
        <?= $form->field($model, 'editorial')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="row">   
        <div class="col-sm-10">   
                <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

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

    
    </div>


    </div>
    
    
    <div class="row">
    <div class="col-xs-12">
        <?= $form->field($model, 'abstract')->textarea(['rows' => 6, 'cols' => 50]) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
