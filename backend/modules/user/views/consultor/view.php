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
                    if($model->status == User::STATUS_ACTIVE && Yii::$app->user->can(AuthItem::DISABLE_CONSULTOR))
                    echo Html::a('desactivar', ['delete', 'id' => $model->user_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]);
                    if($model->status == User::STATUS_DELETED && Yii::$app->user->can(AuthItem::ENABLE_CONSULTOR))
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


<div class="user-view">

   <!--  <h1><?= Html::encode($this->title) ?></h1> -->

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
            <div class="panel-heading"><h3>Préstamos</h3></div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <div class="table-responsive">

                <?php 
                if(count($lendings) != 0){
                    echo 
                    '<table class="table">
                        <thead>
                            <th>Libro</th>
                            <th>Ejemplar</th>
                            <th>Fecha de Autorización</th>
                            <th>Fecha Entrega (Programada)</th>
                            <th>Fecha Entrega (Real)</th>
                        </thead>
                        <tbody>';
                    foreach ($lendings as $lending) {
                        $book         = $lending->getCopy()->all()[0]->getBook()->all()[0]->book_title;
                        $copy         = $lending->copy_id;
                        $authAt       = $lending->lend_auth_at;
                        $returnAt     = $lending->lend_return_at;
                        $realReturnAt = $lending->lend_return_real;

                        $trClass = '';
                        $warning = '';
                                
                        $currentDate    = date_create();
                        $returnDate     = date_create($returnAt);

                        $returnAt   = date_format($returnDate, 'Y-m-d');

                        $diff = date_diff($currentDate, $returnDate);
                        $remaingDays = $diff->format("%R%a días para la entrega");
                        $append = '';
                        if(!$realReturnAt){
                            $append = '<td>' . Html::a('<span class="glyphicon glyphicon-ok"></span>', Url::toRoute(['lending/return', 'copy' => $lending->copy_id , 'user' => $lending->user_id]) , ['class' => 'btn btn-success']) .'</td>';
                                   
                            if($returnDate < $currentDate){
                                $trClass = 'danger';
                            } else {
                                if ($diff->d < 4){
                                    $trClass = "warning";
                                            
                                }
                            }
                        }else {
                            $trClass = 'success';
                        }
                        echo 
                            '<tr>' .  
                                '<td class="' . $trClass .'">' . $book      . '</td>' .
                                '<td class="' . $trClass .'">' .  $copy      . '</td>' .
                                '<td class="' . $trClass .'">' .  $authAt    . '</td>' .
                                '<td class="' . $trClass .'">' .  $returnAt . '  <span  class="glyphicon glyphicon-time" data-toggle="tooltip" title="'. $remaingDays.'!"> ' . '</span>' . '</td>' .
                                '<td class="' . $trClass .'">' .  $realReturnAt . '</td>' . $append .
                            '</tr>';
                    } 
                    echo 
                        '</tbody>
                    </table>';

                } else {
                    echo '<center><h4 class="lend">Sin préstamos.</h4></center>';
                }
                ?>

                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
 
</div>