<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CopySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="copy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'copy_id') ?>

    <?= $form->field($model, 'book_id') ?>

    <?= $form->field($model, 'copy_edition') ?>

    <?= $form->field($model, 'copy_language') ?>

    <?= $form->field($model, 'copy_available') ?>

    <?php echo $form->field($model, 'copy_state') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
