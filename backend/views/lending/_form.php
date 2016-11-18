<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Lending */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lending-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'copy_id')->textInput() ?>

    <?= $form->field($model, 'lend_auth_at')->textInput() ?>

    <?= $form->field($model, 'lend_return_at')->textInput() ?>

    <?= $form->field($model, 'lend_return_real')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
