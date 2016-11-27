<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use backend\models\User;
use backend\models\Copy;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Lending */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lending-form">

    <?php
        $form = ActiveForm::begin();
        $select = ArrayHelper::map(User::find()->all(), 'user_id', 'user_names');
        $select2 = ArrayHelper::map(Copy::find()->all(), 'copy_id', 'copy_id');
    ?>


    <?=
        $form->field($model, 'user_id')->widget(Select2::classname(), [
            'data' => $select,
            'options' => ['placeholder' => 'Select a User'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?=
        $form->field($model, 'copy_id')->widget(Select2::classname(), [
            'data' => $select2,
            'options' => ['placeholder' => 'Select a Copy'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?php
    ?>
    <?=
        $form->field($model, 'lend_auth_at')->widget(
                DatePicker::className(), [
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ['value' => date('Y-m-d'),  'disabled' => true],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy',
                    ]
                ]
        );
    ?>

    <?=
        $form->field($model, 'lend_return_at')->widget(
                DatePicker::className(), [
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ['value' => date('Y-m-d', strtotime('+5 days'))],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy',
                    ]
                ]
        );
    ?>

    <?=
        $form->field($model, 'lend_return_real')->widget(
                DatePicker::className(), [
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ['value' => date('Y-m-d')],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy',
                    ]
                ]
        );
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
