<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\User;
use backend\models\Copy;
use kartik\select2\Select2;
use backend\models\Book;

/* @var $this yii\web\View */
/* @var $model backend\models\Lending */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

    
function dataCopy() {
    $copias = ArrayHelper::map(Copy::find()->all(), 'copy_id', 'copy_available' );
    $arrayCopies = array();
    foreach ($copias as $key => $value) {
        if($value=='Disponible'){
            $libro = Book::find()->where(['book_isbn' => substr($key, 0, 11)])->one();
            $arrayCopies[$key]=substr($libro['book_title'], 0, 30);
        }   
    }
    return $arrayCopies;
}
?>
<div class="lending-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->all(), 'user_id', 'user_names'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],      
    ]);
    ?>

    <?=
    $form->field($model, 'copy_id')->widget(Select2::classname(), [
        'data' => dataCopy(),
        'language' => 'de',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'lend_auth_at')->widget(
            DatePicker::className(), [
        'type' => DatePicker::TYPE_INPUT,
        'options' => ['value' => date('Y-m-d'), "disabled" => true],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d',
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'lend_return_at')->widget(
            DatePicker::className(), [
        'type' => DatePicker::TYPE_INPUT,
        'options' => ['value' => date('Y-m-d', strtotime('+5 days'))],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d',
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'lend_return_real')->widget(
            DatePicker::className(), [
        'type' => DatePicker::TYPE_INPUT,
        'options' => ['value' => date('Y-m-d', strtotime('+5 days'))],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d',
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
