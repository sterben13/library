<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use backend\models\Lending;

use common\models\AuthItem;

use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->user_curp;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$lendings = Lending::find()->where(['user_id' => $model->user_id])->all();

$accountStatus = 'Ok';

if($model->status == User::STATUS_ACTIVE){
    $accountStatus = 'Activa';
}else {
    $accountStatus = 'Suspendida';
}

?>
<div class="user-view">

   <!--  <h1><?= Html::encode($this->title) ?></h1> -->

   <div class="row">
    
       <div class="col-sm-7">
       <div class="panel panel-default">
           <div class="panel-heading"><h3>Información</h3></div>
           <div class="panel-body">
                 <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'user_names',
                        'user_lastname',
                        'user_snd_lastname',
                        'user_curp',
                        'user_email:email',
                        'user_telephone',
                        'user_address',
                        'created_at:date',
                        [
                            'label' => 'Estado de Cuenta',
                            'format' => 'raw',
                            'value' => $accountStatus
                        ]
                    ],
                ]) ?>

                 <p>
                 <div class="btn-group ">
                    <?php
                    echo Html::a('actualizar', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']);
                    if($model->status == User::STATUS_ACTIVE && Yii::$app->user->can(AuthItem::DISABLE_LIBRARIAN))
                    echo Html::a('desactivar', ['delete', 'id' => $model->user_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]);
                    if($model->status == User::STATUS_DELETED && Yii::$app->user->can(AuthItem::ENABLE_LIBRARIAN))
                    echo Html::a('activar', ['reactivate', 'id' => $model->user_id], [
                        'class' => 'btn btn-success',
                        'data' => [
                            'confirm' => 'Are you sure you want to reactivate this item?',
                            'method' => 'post',
                        ],
                    ]);
                     ?>
                 </div>
                </p>

           </div>
       </div>
           
          
       </div>
       <div class="col-sm-5">
           <div class="panel panel-default">
                <div class="panel-heading"><h3>Fotografía</h3></div>
               <div class="panel-body">
               <center>
                    <figure class="img-container"  style="height: 380px;">
                    <?= Html::img($model->user_profile_photo) ?>
                     </figure>
                </center>
               </div>
           </div>
       </div>
   

    </div>

</div>

