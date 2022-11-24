<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
//                    ['label' => 'Home', 'icon' => 'fa fa-home', 'url' => ['index']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => Yii::t('app', 'Adminstrator'),
                        'icon' => 'shield',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'Foydalanuvchilar'), 'icon' => 'users', 'url' => ['/users'],],
                            ['label' => Yii::t('app', 'Role'), 'icon' => 'check-square', 'url' => ['/auth-item/rule'],],
                            ['label' => Yii::t('app', 'Permission'), 'icon' => 'key', 'url' => ['/auth-item/permission'],],
                            ['label' => Yii::t('app', 'Auth assignment'), 'icon' => 'key', 'url' => ['/auth-assignment'],],
                        ],
                    ],
                    [
                        'label' => Yii::t('app', 'HRM'),
                        'icon' => 'male',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'Hodimlar'), 'icon' => 'male', 'url' => ['/hr-employees'],],
//                            ['label' => Yii::t('app', 'Role'), 'icon' => 'file-code-o', 'url' => ['/gii'],],
//                            ['label' => Yii::t('app', 'Permission'), 'icon' => 'file-code-o', 'url' => ['/gii'],],
                        ],
                    ],
                    [
                        'label' => Yii::t('app', "Ma'lumotlar"),
                        'icon' => 'truck',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', "Mahsulot bo'limlari"), 'icon' => 'cog', 'url' => ['/categories'],],
                            ['label' => Yii::t('app', "Mahsulot xususiyalari"), 'icon' => 'cog', 'url' => ['/category-properties'],],
                            ['label' => Yii::t('app', 'Mahsulotlar'), 'icon' => 'cog', 'url' => ['/products'],],
                            ['label' => Yii::t('app', 'Mijozlar'), 'icon' => 'cog', 'url' => ['/clients'],],
                        ],
                    ],
                    [
                        'label' => Yii::t('app', 'Hujjatlar'),
                        'icon' => 'pencil-square-o',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'Kirim'), 'icon' => 'level-down', 'url' => ['/doc-incoming'],],
                            ['label' => Yii::t('app', 'Chiqim'), 'icon' => 'level-up', 'url' => ['/doc-outgoing'],],
                            ['label' => Yii::t('app', "Ko'chirish"), 'icon' => 'refresh', 'url' => ['/doc-moving-in'],],
                        ],
                    ],
                    [
                        'label' => Yii::t('app', 'Xisobotlar'),
                        'icon' => 'pencil-square-o',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'Kirim xisoboti'), 'icon' => 'level-down', 'url' => ['/report/remain'],],
                            ['label' => Yii::t('app', 'Chiqim xisoboti'), 'icon' => 'level-up', 'url' => ['/doc-outgoing/report'],],
                            ['label' => Yii::t('app', "Ko'chirish xisoboti"), 'icon' => 'refresh', 'url' => ['/doc-moving-in/report'],],
                        ],
                    ],
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
        ) ?>

    </section>

</aside>
