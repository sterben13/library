<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\bootstrap\Modal;

?>
<a  data-toggle="modal" data-target="#<?= $model->book_id ?>" >

    <div class="data">
        <div class="row card-header">
            <div>
                <div class="col-xs-12 col-sm-12">
                    <small class="doctype pull-right text-right text-muted">
                        <?php echo Html::img($model->book_cover, ['class' => 'img-responsive']) ?></small>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <h4 style="margin:9px"><?php echo $model->book_title ?></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            if ($author = $model->book_author):
                ?>
                <div class="col-xs-12 col-sm-8">
                    <strong class="text-muted">Autor</strong>
                    <p><?= $author ?></p>
                </div>
            <?php endif ?>
        </div>
    </div>
</a>

<div class="dropdown text-right">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Categorías
        <span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-menu-right">
        <?php
        foreach ($model->getCatNames()->all() as $cat) {
            echo '<li><a >' . $cat->cat_name . '</a></li>';
        }
        ?>
    </ul>
</div>


<hr>
<strong class="text-muted">Resumen</strong>
<div class="abstract"></div>
<p> <?php
    $abstract_overflow = strlen($model->book_abstract) > 150;
    echo substr($model->book_abstract, 0, 150);

    if ($abstract_overflow)
        echo '...';
    ?>
</p>
<?php if ($abstract_overflow): ?>
    <a data-toggle="modal" data-target="#abstract-<?= $model->book_id ?>">Ver más</a>
<?php endif ?>
</a>

<?php if ($abstract_overflow): ?>
    <div class="modal fade" id="abstract-<?= $model->book_id ?>" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title">Resumen - <small><?= $model->book_title ?></small> </h3>
                </div>
                <div class="modal-body">
                    <p><?= $model->book_abstract ?></p>
                </div>
            </div><!-- dic.modal-content-->
        </div><!-- div.modal-dialog.modal-lg-->
    </div> <!-- div.modal.fade-->
<?php endif ?>

<div class="modal fade" id="<?= $model->book_id ?>" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="onClick('<?= $model->book_id ?>')" class="btn btn-primary">Pantalla completa</button>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div style="text-align: center;">
                    <iframe id="frame-<?= $model->book_id ?>" src= "" 
                            style="width:100%; height:500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div><!-- dic.modal-content-->
    </div><!-- div.modal-dialog.modal-lg-->
</div> <!-- div.modal.fade-->


<script type="text/javascript">

    function onClick(id) {
        console.log(id);
        iframe = document.getElementById('frame-' + id);
        launchIntoFullscreen(iframe);
    }

    function launchIntoFullscreen(element) {
        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) {
            element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) {
            element.msRequestFullscreen();
        } else {
            console.log('what');
        }
    }

// Whack fullscreen
    function exitFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
</script>