<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Lending */

$this->title = 'Actualización del Préstamo ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Préstamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'copy_id' => $model->copy_id]];
$this->params['breadcrumbs'][] = 'Actualización';
?>
<div class="lending-update">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
