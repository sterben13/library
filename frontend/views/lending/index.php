<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LendingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lendings';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/js/main.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>

<div class="lending-index">

    <?php
    yii\bootstrap\Modal::begin([
            'header'=>'<h4>Detalle del Prestamo</h4>',
            'id'=>'modal',
            'size'=>'modal-lg'
        ]);
        echo "<div id='modalContent'> </div>";
        yii\bootstrap\Modal::end();
    ?>
    

    <?=
    \yii2fullcalendar\yii2fullcalendar::widget([
        'events'=> $events
        
    ]);
    ?>
</div>
