<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'book_isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_abstract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_cover')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_editorial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categories')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Category::find()->all(), 'cat_name', 'cat_name'),
            'options' => ['placeholder' => 'Selecciona una categoría ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
        ])->label('Tag Multiple');
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
