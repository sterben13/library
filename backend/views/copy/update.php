<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Copy */

$this->title = 'Actualizar Registro';
$this->params['breadcrumbs'][] = ['label' => 'Copias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->copy_id, 'url' => ['view', 'id' => $model->copy_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="copy-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
