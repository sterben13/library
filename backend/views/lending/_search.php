<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LendingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lending-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
    	<div class="col-xs-8">
    		<?= $form->field($model, 'user_id')->textInput(['placeholder' => 'Búsqueda...'])->label(false) ?>
    	</div>
    	<div class="col-xs-2">
    		<div class="form-group">
		        <?= Html::submitButton('<span class="fa fa-search"></span> Search', ['class' => 'btn btn-primary']) ?>
		    </div>
    	</div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
