<?php

use yii\helpers\Html;
use yii\helpers\URL;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <fieldset>
        <legend>Datos Personales</legend>
        <div class="row">
        
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-7">
                        <?= $form->field($model, 'user_names')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'user_curp')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'user_lastname')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'user_snd_lastname')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <?php 
                if($model->isNewRecord)
                    echo $form->field($model, 'password_hash')->textInput(['maxlength' => true])
                ?>
            </div>

            <div class="col-sm-4">
                <center>
                <figure class="form-group">
                <?= 
                    Html::img($model->isNewRecord ? Url::to('@web/img/photos/user-default.png') :  $model->user_profile_photo,
                        [
                            'id' => 'preview-img',
                            'class' => 'profile-photo',
                            'alt' => 'Fotografía'
                        ]);
                ?>
                </figure>
                 <?= $form->field($model, 'image')->fileInput([
                    'id' => 'image-input',
                    'accept' => 'image/*',
                    'onchange' => 'showPreview("#preview-img", this);'
                    ]) ?>
                </center>
            </div>

        </div>
    </fieldset>
    <fieldset>
        <legend>Datos de Contacto</legend>
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'user_email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'user_telephone')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <?= $form->field($model, 'user_address')->textInput(['maxlength' => true]) ?>
    </fieldset>   
    



    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
