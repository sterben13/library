<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Lending */

$this->title = 'Create Lending';
$this->params['breadcrumbs'][] = ['label' => 'Lendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lending-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
