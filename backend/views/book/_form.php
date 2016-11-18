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

    <style type="text/css">
        input[type=file] {
            color:transparent;
        }

    </style> 
    <script type="text/javascript">
        function showPreview(target, input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
    <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-0 col-md-3 ">
        <figure>
         <!-- <img id="preview-img" class="img-responsive" src="<?= Url::to('@web/img/covers/generic-book-cover.jpg') ?>" alt="Portada de libro"> -->
        <?= 
            Html::img($model->isNewRecord ? Url::to('@web/img/covers/generic-book-cover.jpg') :  $model->book_cover,
                [
                    'id' => 'preview-img',
                    'class' => 'img-responsive',
                    'alt' => 'Portada de libro'
                ])
        ?>
        </figure>
        <!-- <label class="btn btn-default btn-lg btn-block">UPLOAD -->
        <?= $form->field($model, 'coverImg')->fileInput([
            'id' => 'image-input',
            'accept' => 'image/*',

            //'required' => $model->isNewRecord ? 'true' : 'false',
            'onchange' => 'showPreview("preview-img", this);'
            ])->label(false) ?>
        <!-- </label> -->
    </div>
    <br>

    <div class="col-xs-12 col-sm-8 col-md-9">

    <div class="row">   
        <div class="col-sm-6">   
        <?= $form->field($model, 'book_isbn')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-6">   
        <?= $form->field($model, 'book_editorial')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <?= $form->field($model, 'book_title')->textInput(['maxlength' => true]) ?>

    <div class="row">   
        <div class="col-sm-10">   
                <?= $form->field($model, 'book_author')->textInput(['maxlength' => true]) ?>

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
        <?= $form->field($model, 'book_abstract')->textarea(['rows' => 6, 'cols' => 50]) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
