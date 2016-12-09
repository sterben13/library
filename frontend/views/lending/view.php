<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\User;
use backend\models\Book;
use backend\models\Copy;
/* @var $this yii\web\View */
/* @var $model frontend\models\Lending */

$this->title = $model->lending_id;
$this->params['breadcrumbs'][] = ['label' => 'Lendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lending-view">

    

    <p>
        
        
    </p>

    <?= DetailView::widget([
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

