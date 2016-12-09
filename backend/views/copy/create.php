<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Copy */

$this->title = 'Registro del Ejemplar';
$this->params['breadcrumbs'][] = ['label' => 'Copies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="copy-create">

    <!---<h1><?= Html::encode($this->title) ?></h1>--->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
