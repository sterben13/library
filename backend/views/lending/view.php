<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
use backend\models\Copy;
use backend\models\Book;

/* @var $this yii\web\View */
/* @var $model backend\models\Lending */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Préstamo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lending-view">

    <h1><?php
        // Html::encode($this->title);
        ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'user_id' => $model->user_id, 'copy_id' => $model->copy_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'user_id' => $model->user_id, 'copy_id' => $model->copy_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
                [
                    'attribute' => 'user_id',
                    'value' => user($model->user_id)
                ],
                [
                    'attribute' => 'copy_id',
                    'value' => Book::find()
                                ->where([
                                    'book_id' => Copy::find()
                                        ->where([
                                            'copy_id' => $model->copy_id
                                        ])
                                        ->one()
                                        ->book_id
                                ])
                                ->one()->book_title
                ],
                [
                    'attribute' => 'lend_auth_at',
                    'value' => dateFormatter($model->lend_auth_at)
                ],
                [
                    'attribute' => 'lend_return_at',
                    'value' => dateFormatter($model->lend_return_at)
                ],
                [
                    'attribute' => 'lend_return_real',
                    'value' => dateFormatter($model->lend_return_real)
                ],
        ],
    ])
    ?>

</div>
<?php

function user($id) {
    $user = User::find()->where(['user_id' => $id])->one();
    return $user['user_names']
            . ' ' . $user['user_lastname']
            . ' ' . $user['user_snd_lastname'];
}

function dateFormatter($date) {
    Yii::$app->formatter->locale = 'es-mx';
    return yii\bootstrap\Html::encode(Yii::$app->formatter->asDate($date));
}
?>
