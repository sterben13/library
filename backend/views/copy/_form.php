<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Copy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="copy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'copy_id')->textInput() ?>

    <?= $form->field($model, 'book_id')->textInput() ?>

    <?= $form->field($model, 'copy_edition')->dropDownList([ 'First' => 'First', 'Second' => 'Second', 'Third' => 'Third', 'Fourth' => 'Fourth', 'Fifth' => 'Fifth', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'copy_language')->dropDownList([ 'Spanish' => 'Spanish', 'English' => 'English', 'Chinese' => 'Chinese', 'Russian' => 'Russian', 'Arabic' => 'Arabic', 'Portuguese' => 'Portuguese', 'French' => 'French', 'Japanese' => 'Japanese', 'Turkish' => 'Turkish', 'German' => 'German', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'copy_available')->textInput() ?>

    <?= $form->field($model, 'copy_state')->dropDownList([ 'Ok' => 'Ok', 'Damaged' => 'Damaged', 'Incomplete' => 'Incomplete', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
