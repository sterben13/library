<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use backend\models\Book;
use backend\models\Copy;
use yii\helpers\ArrayHelper;

?>

<div class="copy-form">

    <?php $form = ActiveForm::begin();
    $select= ArrayHelper::map(Book::find()->all(),
                'book_id', 'book_title'
            ); ?>

    <?php //echo $form->field($model, 'copy_id')->textInput() ?>

    <?= $form->field($model, 'book_id')->widget(Select2::className(),[
        'data' => ArrayHelper::map(Book::find()->all(), 'book_id', 'book_title'),
        'options' => ['placeholder' => 'Seleccione un titulo'],
        'pluginOptions' => [
            'allowClear' => true
            ],
        ]);
    ?>

    <div class="row">
        <div class="col-xs-6">
    <?= $form
        ->field($model, 'copy_edition')
        ->dropDownList([ 
            'First' => 'Primera', 
            'Second' => 'Segunda', 
            'Third' => 'Tercera', 
            'Fourth' => 'Cuarta', 
            'Fifth' => 'Quinta', 
        ], 
        ['prompt' => 'Seleccione una Edición']) ?>
        </div>
        <div class="col-xs-6">
    
     <?= $form
        ->field($model, 'copy_language')
        ->dropDownList([ 
            'Spanish' => 'Español', 
            'English' => 'Inglés', 
            'Chinese' => 'Chino', 
            'Russian' => 'Ruso', 
            'Arabic' => 'Arábigo', 
            'Portuguese' => 'Portugués', 
            'French' => 'Francés', 
            'Japanese' => 'Japonés', 
            'Turkish' => 'Turco', 
            'German' => 'Alemán', 
        ], ['prompt' => 'Seleccione un idioma']) ?>

        </div>
    </div>


    <div class="row">
        <div class="col-xs-6">
    <?php
    if($model->isNewRecord)
        $model->copy_available = Copy::AVAILABLE;
    echo $form
        ->field($model, 'copy_available')
        ->dropDownList([ 
            Copy::AVAILABLE     => 'Disponible', 
            Copy::UNAVAILABLE   => 'Ocupado'
        ], ['prompt' => 'Selecione la disponibilidad', 'disabled' => $model->isNewRecord]) ?>
        </div>
        <div class="col-xs-6">
    
    <?= $form
        ->field($model, 'copy_state')
        ->dropDownList([ 
            Copy::STATE_OK => 'Ok', 
            Copy::STATE_DAMAGED => 'Dañado', 
            Copy::STATE_INCOMPLETE => 'Incompleto', 
        ], ['prompt' => 'Estado del Ejemplar']) ?>
        </div>
    </div>

    


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
