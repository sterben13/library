<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Lending */

$this->title = 'Update Lending: ' . $model->lending_id;
$this->params['breadcrumbs'][] = ['label' => 'Lendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lending_id, 'url' => ['view', 'lending_id' => $model->lending_id, 'user_id' => $model->user_id, 'copy_id' => $model->copy_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lending-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
