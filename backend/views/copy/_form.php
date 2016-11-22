<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Book;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Copy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="copy-form">

    <?php $form = ActiveForm::begin();
    $select= ArrayHelper::map(Book::find()->all(),
                'book_id', 'book_title'
            ); ?>

<!--    <?  $form->field($model, 'copy_id')->textInput() ?>-->

    <?= $form->field($model, 'book_id')->widget(Select2::classname(), [
        'data' => $select,
        'options' => ['placeholder' => 'Select a Book'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ]);
    ?>

    <?= $form->field($model, 'copy_edition')->dropDownList([
        'First' => 'First',
        'Second' => 'Second',
        'Third' => 'Third', 
        'Fourth' => 'Fourth', 
        'Fifth' => 'Fifth',],
        ['prompt' => 'Select a Edition']) ?>

    <?= $form->field($model, 'copy_language')->dropDownList([
        'Spanish' => 'Spanish', 
        'English' => 'English', 
        'Chinese' => 'Chinese', 
        'Russian' => 'Russian', 
        'Arabic' => 'Arabic', 
        'Portuguese' => 'Portuguese', 
        'French' => 'French', 
        'Japanese' => 'Japanese', 
        'Turkish' => 'Turkish', 
        'German' => 'German',],
        ['prompt' => 'Select a language']) ?>

    <?= $form->field($model, 'copy_available')->textInput() ?>

    <?= $form->field($model, 'copy_state')->dropDownList([
        'Ok' => 'Ok', 
        'Damaged' => 'Damaged', 
        'Incomplete' => 'Incomplete',],
        ['prompt' => 'Select a state']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
