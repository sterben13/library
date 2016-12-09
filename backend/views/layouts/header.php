<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

            

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->user->identity->user_profile_photo ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= Yii::$app->user->identity->user_names?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?= Yii::$app->user->identity->user_profile_photo ?>" class="img-circle"
                                 alt="User Image"/>
                            <p>
                            <?php 
                                $username = Yii::$app->user->identity->user_names;
                                $id= Yii::$app->user->identity->id;
                                $epoch = Yii::$app->user->identity->created_at;
                                $dt = new DateTime("@$epoch");
                                $creation_date = $dt->format('d-m-Y');
                            ?> 

                            <?= $username?>
                                <small>Member since <?= $creation_date ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Profile',
                                    ['/user/view', 'id'=>$id],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

               
            </ul>
        </div>
    </nav>
</header>
