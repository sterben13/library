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
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?php

        if(Yii::$app->user->can('super-user')) {

        echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Acervo', 'options' => ['class' => 'header']],
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
                   

                    ['label' => 'Usuarios', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Usuarios',
                        'icon' => 'fa fa-users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Administradores', 'icon' => 'fa fa-user-circle-o', 'url' => ['/user/admin'],],
                            ['label' => 'Bibliotecarios', 'icon' => 'fa fa-address-book', 'url' => ['/user/librarian'],],
                            ['label' => 'Consultores', 'icon' => 'fa fa-search', 'url' => ['/user/consultor'],],
                        ],
                    ],

                    ['label' => 'Préstamos', 'icon' => 'fa fa-clock-o', 'url' => ['/lending']],


                    ['label' => '', 'options' => ['class' => 'header']],
                    ['label' => 'Cerrar Sesión', 'icon' => 'fa fa-power-off', 'url' => ['/site/logout']],
                    
                ],
            ]
        );
        } else if(Yii::$app->user->can('admin')) {

        echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Acervo', 'options' => ['class' => 'header']],
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
                   

                    ['label' => 'Usuarios', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Usuarios',
                        'icon' => 'fa fa-users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Bibliotecarios', 'icon' => 'fa fa-address-book', 'url' => ['/user/librarian'],],
                            ['label' => 'Consultores', 'icon' => 'fa fa-search', 'url' => ['/user/consultor'],],
                        ],
                    ],

                    ['label' => 'Préstamos', 'icon' => 'fa fa-clock-o', 'url' => ['/lending']],


                    ['label' => '', 'options' => ['class' => 'header']],
                    ['label' => 'Cerrar Sesión', 'icon' => 'fa fa-power-off', 'url' => ['/site/logout']],
                    
                ],
            ]
        );
        } else if(Yii::$app->user->can('librarian')) {

        echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Acervo', 'options' => ['class' => 'header']],
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
                   

                    ['label' => 'Usuarios', 'options' => ['class' => 'header']],
                    ['label' => 'Consultores', 'icon' => 'fa fa-clock-o', 'url' => ['/user/consultor']],
                    ['label' => 'Préstamos', 'icon' => 'fa fa-clock-o', 'url' => ['/lending']],


                    ['label' => '', 'options' => ['class' => 'header']],
                    ['label' => 'Cerrar Sesión', 'icon' => 'fa fa-power-off', 'url' => ['/site/logout']],
                    
                ],
            ]
        );

        }


         ?>

    </section>

</aside>
