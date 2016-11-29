<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use backend\models\Book;
use yii\helpers\ArrayHelper;

?>

<div class="copy-form container-fluid" style="background: white">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'copy_id')->textInput() ?>

    <?= $form->field($model, 'book_id')->widget(Select2::className(),[
        'data' => ArrayHelper::map(Book::find()->all(), 'book_id', 'book_title'),
        'options' => ['placeholder' => 'Seleccione un titulo'],
        'pluginOptions' => [
            'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'copy_edition')->dropDownList([ 'First' => 'First', 'Second' => 'Second', 'Third' => 'Third', 'Fourth' => 'Fourth', 'Fifth' => 'Fifth', ], ['prompt' => 'Seleccione una Edición']) ?>

    <?= $form->field($model, 'copy_language')->dropDownList([ 'Spanish' => 'Spanish', 'English' => 'English', 'Chinese' => 'Chinese', 'Russian' => 'Russian', 'Arabic' => 'Arabic', 'Portuguese' => 'Portuguese', 'French' => 'French', 'Japanese' => 'Japanese', 'Turkish' => 'Turkish', 'German' => 'German', ], ['prompt' => 'Seleccione un lenguaje']) ?>

    <?= $form->field($model, 'copy_available')->dropDownList([ 'Disponible' => 'Disponible', 'Ocupado' => 'Ocupado'], ['prompt' => 'Selecione la disponibilidad']) ?>

    <?= $form->field($model, 'copy_state')->dropDownList([ 'Ok' => 'Ok', 'Damaged' => 'Damaged', 'Incomplete' => 'Incomplete', ], ['prompt' => 'Estado del Ejemplar']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
