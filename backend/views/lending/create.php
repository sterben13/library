<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Lending */

$this->title = 'Autorización';
$this->params['breadcrumbs'][] = ['label' => 'Préstamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lending-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
