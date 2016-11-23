<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('registrar usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_curp',
            [
                'label' => 'Usuario',
                'value' => function ($model) {
                    return $model->user_names . ' ' . $model->user_lastname . ' ' . $model->user_snd_lastname;
                }
            ],
            
            'user_email:email',
            // 'user_telephone',
            // 'user_address',
            // 'user_profile_photo',
            // 'created_at',
            // 'updated_at',
            // 'password_hash',
            // 'auth_key',
            // 'password_reset_token',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
