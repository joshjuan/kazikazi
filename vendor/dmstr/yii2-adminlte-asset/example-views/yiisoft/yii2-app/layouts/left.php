<?php

use dmstr\widgets\Menu;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p> <?php if (!Yii::$app->user->isGuest) {
                        //  echo " " . Yii::$app->user->identity->username;

                        echo Yii::$app->user->identity->name;
                        //   $user_id = Yii::$app->user->identity->id

                    } else if (Yii::$app->user->isGuest) {

                        return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());


                    }
                    ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Home', 'icon' => 'home text-orange', 'url' => ['/'],],
                    [
                        'label' => 'Ticket Transactions',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('super_admin') || Yii::$app->user->can('manager'),
                        'icon' => 'sun-o text-orange',
                        'items' => [

                            [
                              //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Ticket Transaction List'),
                                'url' => ['/ticket-transaction/index'],
                                'icon' => 'lock text-orange',
                            ],

                        ],
                    ],

                    [
                        'label' => 'Region',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('super_admin') || Yii::$app->user->can('manager'),
                        'icon' => 'sun-o text-orange',
                        'items' => [
                            [
                              //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'New Region'),
                                'url' => ['/region/create'],
                                'icon' => 'plus text-orange',
                            ],
                            [
                              //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Region List'),
                                'url' => ['/region/index'],
                                'icon' => 'lock text-orange',
                            ],

                        ],
                    ],
                    [
                        'label' => 'District',
                      //  'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('super_admin') || Yii::$app->user->can('manager'),
                        'icon' => 'sun-o text-orange',
                        'items' => [
                            [
                              //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'New District'),
                                'url' => ['/district/create'],
                                'icon' => 'plus text-orange',
                            ],
                            [
                              //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'District Lists'),
                                'url' => ['/district/index'],
                                'icon' => 'plus text-orange',
                            ],


                        ],
                    ],
                    [
                        'label' => 'Municipal',
                      //  'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('super_admin') || Yii::$app->user->can('manager'),
                        'icon' => 'sun-o text-orange',
                        'items' => [
                            [
                                //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Add New Municipal'),
                                'url' => ['/municipal/create'],
                                'icon' => 'lock text-orange',
                            ],

                            [
                                //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Municipal List'),
                                'url' => ['/municipal/index'],
                                'icon' => 'lock text-orange',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Street',
                      //  'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('super_admin') || Yii::$app->user->can('manager'),
                        'icon' => 'sun-o text-orange',
                        'items' => [
                            [
                                //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Add New Street'),
                                'url' => ['/street/create'],
                                'icon' => 'lock text-orange',
                            ],

                            [
                                //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Street List'),
                                'url' => ['/street/index'],
                                'icon' => 'lock text-orange',
                            ],
                        ],
                    ],
                    [
                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                        'label' => Yii::t('app', 'Work Area'),
                        //'url' => [''],
                        'icon' => 'lock text-orange',
                        'items'=>[
                            [
                                //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Add Wok Area'),
                                'url' => ['/work-area/create'],
                                'icon' => 'lock text-orange',
                            ],

                            [
                                //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Work Area Lists'),
                                'url' => ['/work-area/index'],
                                'icon' => 'lock text-orange',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Office Setup',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('super_admin') || Yii::$app->user->can('manager'),
                        'icon' => 'sun-o text-orange',
                        'items' => [

                            [
                              //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Audit Trail'),
                                'url' => ['/audit/index'],
                                'icon' => 'lock text-orange',
                            ],

                        ],
                    ],
                    [
                        'label' => 'System User',

                        'icon' => 'folder-open-o text-orange',
                        'url' => [''],
                        'items' => [
                            [

                                'label' => 'Staffs List',
                                'icon' => 'user text-green',
                                'url' => ['/user/index'],

                            ],

                            ['label' => 'Clerk List', 'icon' => 'user text-orange', 'url' => [''],],



                        ],
                    ],
                    [
                        'label' => 'Settings',
                        // 'visible' => Yii::$app->user->can('Administrator') || Yii::$app->user->can('Super_Administrator'),
                        'icon' => 'cogs text-orange',
                        'items' => [
                            ['label' => 'Users', 'icon' => 'user text-orange', 'url' => ['/user'],],
                            [
                                'visible' => Yii::$app->user->can('admin') || yii::$app->user->can('super_admin')||yii::$app->user->can('auditor'),
                                'label' => Yii::t('app', 'Audit Trail'),
                                'url' => ['/audit/index'],
                                'icon' => 'lock text-orange',
                            ],

                            [
                                'visible' => (Yii::$app->user->identity->username == 'super_admin'||Yii::$app->user->identity->username == 'admin'),
                                'label' => Yii::t('app', 'Manager Permissions'),
                                'url' => ['/auth-item/index'],
                                'icon' => 'fa fa-lock text-orange',
                            ],
                            [
                                'label' => 'Super Roles',
                                  'visible' => Yii::$app->user->can('super_admin'),
                                'icon' => 'lock text-orange',
                                'url' => ['/auth-item-child'],
                            ],
                            [
                                'visible' => (Yii::$app->user->identity->username == 'super_admin'||Yii::$app->user->identity->username == 'admin'),
                                'label' => Yii::t('app', 'Manage User Roles'),
                                'url' => ['/role/index'],
                                'icon' => 'fa fa-lock text-orange',
                            ],
                            [
                                'label' => 'Assign Permissions ',
                                'visible' => (Yii::$app->user->identity->username == 'super_admin'||Yii::$app->user->identity->username == 'admin'),
                                'icon' => 'lock text-orange', 'url' => ['/auth-assignment'],
                            ],
                        ],
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
