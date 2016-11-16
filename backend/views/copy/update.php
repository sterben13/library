<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Copy */

$this->title = 'Update Copy: ' . $model->copy_id;
$this->params['breadcrumbs'][] = ['label' => 'Copies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->copy_id, 'url' => ['view', 'id' => $model->copy_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="copy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
