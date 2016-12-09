<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LendingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lending-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'lending_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'copy_id') ?>

    <?= $form->field($model, 'lend_auth_at') ?>

    <?= $form->field($model, 'lend_return_at') ?>

    <?php // echo $form->field($model, 'lend_return_real') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
