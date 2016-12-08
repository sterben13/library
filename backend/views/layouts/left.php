<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->user->identity->user_profile_photo ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->user_names ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->

        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Sitema de Gestion', 'options' => ['class' => 'header']],
                    //['label' => 'Libros', 'icon' => 'fa fa-book', 'url' => ['/book']],
                    [
                        'label' => 'Librería',
                        'icon' => 'fa fa-book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Libros', 'icon' => 'mdi mdi-book', 'url' => ['/book'],],
                            ['label' => 'Ejemplares', 'icon' => 'mdi mdi-content-copy', 'url' => ['/copy'],],
                        ],
                    ],
                    ['label' => 'Categorías', 'icon' => 'fa fa-tag', 'url' => ['/category']],
                    ['label' => 'Copias', 'icon' => 'fa fa-file-code-o', 'url' => ['/copy']],
                    ['label' => 'Préstamos', 'icon' => 'fa fa-clock-o', 'url' => ['/lending']],
                    ['label' => 'Usuarios', 'icon' => 'fa fa-user-circle-o', 'url' => ['/user']],

                    
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    
                ],
            ]
        ) ?>

    </section>

</aside>
