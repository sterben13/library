<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Libros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <style type="text/css">
        .flex-container {
            display: -webkit-flex;
            display: flex;

            -webkit-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-justify-content: center;
            justify-content: center;
            width: 100%;
            height: 500px;
            overflow-y: auto;
            background-color: #EEEEEE;

        }



        .doc-card{
            background-color:#ffffff;
            margin: 10px ;
            padding:15px;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.2);
            -webkit-transition: box-shadow 0.5s; /* Safari */
            transition: box-shadow 0.5s;

        }

        .doc-card:hover {
            box-shadow: 0 4px 16px 0 rgba(0, 0, 0, 0.5);
        }

        .doc-card > a {
            color: black;
            cursor: pointer;
        }

        .doc-card  h4 {
            margin-bottom: 0px;
        }

        .doc-card
        .data {
            height: 150px;
        }

        .doc-card
        .abstract {
            height: 20px;
        }

        .doc-card
        .card-header {
            height: 70px;
        }


        @media only screen and (min-width: 600px) {
            .doc-card{
                width: 40%;
            }
        }

        @media only screen and (min-width: 1200px) {
            .doc-card{
                width: 30%;
            }
        }

    </style>
    <?php
    Modal::begin([
        'header' => '<h4>Documentos</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
    ?>
    <?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['tag' => 'div'],
        'itemView' => 'doc-card',
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'doc-card',
            'title' => 'Click para mostrar el documento'
        ],
        'layout' => '{summary} <div class="flex-container" >{items}</div> {pager}'
    ])
    ?>
</div>
