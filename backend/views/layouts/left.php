<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->user_names ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Gestión', 'options' => ['class' => 'header']],
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
                    //['label' => 'Copias', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Préstamos', 'icon' => 'fa fa-clock-o', 'url' => ['/lending']],
                    ['label' => 'Usuarios', 'icon' => 'fa fa-user-circle-o', 'url' => ['/user']],

                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    
                ],
            ]
        ) ?>

    </section>

</aside>
