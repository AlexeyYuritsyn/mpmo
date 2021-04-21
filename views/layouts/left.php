<?php
use app\models\Users;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
<!--        <div class="user-panel">-->
<!--            <div class="pull-left image">-->
<!--                <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
<!--            </div>-->
<!--            <div class="pull-left info">-->
<!--                <p>Alexander Pierce</p>-->
<!---->
<!--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
<!--            </div>-->
<!--        </div>-->

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <?php if(Yii::$app->user->identity->role == Users::ROLE_ADMIN)
        {
            echo dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        [
                            'label' => 'Работы',
                            'icon' => 'file-text-o',
                            'url' => '#',
                            'active' => true,
                            'items' => [
                                ['label' => 'Этап 1', 'icon' => 'sitemap', 'url' => ['/work/all-work','round'=>1],],
                                ['label' => 'Этап 2', 'icon' => 'sitemap', 'url' => ['/work/all-work','round'=>2],],
                            ]
                        ],
                        ['label' => 'Статистика', 'icon' => 'line-chart', 'url' => ['/administrator/statistics']],
                        ['label' => 'Пользователи', 'icon' => 'users', 'url' => ['/questionnaire/all-users']],
                        ['label' => 'Настройки сайта', 'icon' => 'gears', 'url' => ['/work/project-setup']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Some tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
                    ],
                ]
            );

        }
        else if(Yii::$app->user->identity->role == Users::ROLE_EXPERT)
        {
            echo dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        [
                            'label' => 'Работы',
                            'icon' => 'file-text-o',
                            'url' => '#',
                            'active' => true,
                            'items' => [
                                ['label' => 'Этап 1', 'icon' => 'sitemap', 'url' => ['/work/all-work','round'=>1],],
                                ['label' => 'Этап 2', 'icon' => 'sitemap', 'url' => ['/work/all-work','round'=>2],],
                            ]
                        ],
                        ['label' => 'Профиль', 'icon' => 'pencil-square-o', 'url' => ['/questionnaire/my-profile']],
                    ],
                ]
            );
        }
        else if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT)
        {
            $items = [];
            if(Yii::$app->user->identity->second_round == true)
            {
                $items = [
                    'label' => 'Работы',
                    'icon' => 'file-text-o',
                    'url' => '#',
                    'active' => true,
                    'items' => [
                        ['label' => 'Этап 1', 'icon' => 'sitemap', 'url' => ['/work/all-work','round'=>1],],
                        ['label' => 'Этап 2', 'icon' => 'sitemap', 'url' => ['/work/all-work','round'=>2],],
                    ]
                ];
            }
            else
            {
                $items = ['label' => 'Работы 1 этапа', 'icon' => 'sitemap', 'url' => ['/work/all-work','round'=>1]];
            }

            echo dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        $items,

//                        ['label' => 'Работы', 'icon' => 'file-text-o', 'url' => ['/work/all-work']],
                        ['label' => 'Анкета', 'icon' => 'pencil-square-o', 'url' => ['/questionnaire/my-profile']],
                    ],
                ]
            );
        }
        ?>

    </section>

</aside>
