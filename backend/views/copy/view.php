<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Copy */

$this->title = $model->copy_id;
$this->params['breadcrumbs'][] = ['label' => 'Copies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="copy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->copy_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->copy_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'copy_id',
            'book_id',
            'copy_edition',
            'copy_language',
            'copy_available',
            'copy_state',
        ],
    ]) ?>

</div>
