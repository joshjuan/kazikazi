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
                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewTicketTransactionModule'),
                        'icon' => 'money text-orange',
                        'items' => [

                            [
                                //   'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewTicketTransactionSubModule'),
                                'label' => Yii::t('app', 'Ticket Transaction'),
                                'url' => ['/ticket-transaction/index'],
                                'icon' => 'lock text-orange',
                            ],
                            [
                                //   'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewTicketTransactionSubModule'),
                                'label' => Yii::t('app', 'Ticket Reprinted'),
                                'url' => ['/ticket-reprinted/index'],
                                'icon' => 'lock text-orange',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Ticket Transactions',
                        'visible' =>  Yii::$app->user->can('governmentOfficial'),
                        'icon' => 'money text-orange',
                        'items' => [
                            [
                                'visible' => yii::$app->user->can('governmentOfficial'),
                                'label' => Yii::t('app', 'Ticket Transaction'),
                                'url' => ['/ticket-transaction/government-index'],
                                'icon' => 'lock text-orange',
                            ],


                        ],
                    ],
                    [
                        'label' => 'Funga Hesabu',
                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewFungaMahesabuModule'),
                        'icon' => 'money text-orange',
                        'items' => [

                            [
                                'label' => 'Supervisor Mahesabu',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewFungaMahesabuModule'),
                                'icon' => 'folder-open text-orange',
                                'items' => [
                                    [

                                        'label' => Yii::t('app', 'Funga Supervisor Mahesabu'),
                                        'url' => ['/supervisor-deni/create'],
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createFungaSupervisorMahesabuModule'),
                                        'icon' => 'circle text-green',
                                    ],
                                    [

                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewFungaMahesabuModule'),
                                        'label' => Yii::t('app', 'Mahesabu ya supervisor'),
                                        'url' => ['/supervisor-deni/index'],
                                        'icon' => 'circle text-green',
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Accountant Mahesabu',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewFungaMahesabuModule'),
                                'icon' => 'folder-open text-orange',
                                'items' => [

                                    [
                                        'label' => Yii::t('app', 'Funga siku Mahesabu'),
                                        'url' => ['/accountant-report/create'],
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createAccountantMahesabuModule'),
                                        'icon' => 'circle text-red',
                                    ],
                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewFungaMahesabuModule'),
                                        'label' => Yii::t('app', 'Mahesabu yaliyofungwa'),
                                        'url' => ['/accountant-report/index'],
                                        'icon' => 'circle text-red',
                                    ],

                                ],

                            ],

                        ],
                    ],
                    [
                        'label' => 'Reports',
                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewReportModule'),
                        'icon' => 'sitemap text-orange',
                        'items' => [
                            [
                                'label' => 'Custom Clerk Report',
                                'icon' => 'money text-green',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewReportModule'),
                                'url' => ['/ticket-transaction/clerk-report'],
                            ],
                            [
                                'label' => 'Region wise Report',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewReportModule'),
                                'icon' => 'money text-green',
                                'url' => ['/ticket-transaction/date-range'],
                            ],
                            [
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewReportModule'),
                                'label' => 'Clerks Closed Report',
                                'icon' => 'money text-green',
                                'url' => ['/clerk-deni/clerk-report'],
                            ],
                            [
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewReportModule'),
                                'label' => 'Supervisors Closed Report',
                                'icon' => 'money text-green',
                                'url' => ['/supervisor-deni/supervisor-report'],
                            ],
                    /*        [
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewReportModule'),
                                'label' => 'Ripoti ya Accountant',
                                'icon' => 'money text-green',
                                'url' => ['/supervisor-deni/supervisor-report'],
                            ], */
                            [
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewReportModule'),
                                'label' => 'Accountant Closed Report',
                                'icon' => 'money text-green',
                                'url' => ['/accountant-report/report'],
                            ],


                        ],
                    ],
                    [
                        'label' => 'Reports',
                        'visible' => yii::$app->user->can('governmentOfficial'),
                        'icon' => 'sitemap text-orange',
                        'items' => [
                            [
                                'visible' => yii::$app->user->can('governmentOfficial'),
                                'label' => 'Accountant closed Report',
                                'icon' => 'money text-green',
                                'url' => ['/accountant-report/gvt-report'],
                            ],

                        ],
                    ],
                    [
                        'label' => 'Claim Reports',
                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewClaimReportModule'),
                        'icon' => 'sitemap text-orange',
                        'items' => [

                            [
                                'label' => 'Claim Report',
                                'icon' => 'circle text-green',
                                //'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('super_admin'),
                                'url' => ['/claim-report'],
                            ],


                        ],
                    ],
                    [
                        'label' => 'Area Configuration',
                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewStreet') || Yii::$app->user->can('viewMunicipal') || Yii::$app->user->can('viewRegion') || Yii::$app->user->can('viewDistrict') || Yii::$app->user->can('viewWorkArea'),
                        'icon' => 'database text-orange',
                        'items' => [

                            [
                                'label' => 'Region',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewRegion'),
                                'icon' => 'map-marker text-orange',
                                'items' => [
                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'label' => Yii::t('app', 'New Region'),
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createRegion'),
                                        'url' => ['/region/create'],
                                        'icon' => 'plus text-green',
                                    ],
                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'label' => Yii::t('app', 'Region List'),
                                        'url' => ['/region/index'],
                                        'icon' => 'circle text-green',
                                    ],

                                ],
                            ],
                            [
                                'label' => 'District',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewDistrict'),
                                'icon' => 'sun-o text-orange',
                                'items' => [
                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'label' => Yii::t('app', 'New District'),
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createDistrict'),
                                        'url' => ['/district/create'],
                                        'icon' => 'plus text-green',
                                    ],
                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'label' => Yii::t('app', 'District Lists'),
                                        'url' => ['/district/index'],
                                        'icon' => 'list circle text-green',
                                    ],


                                ],
                            ],
                            [
                                'label' => 'Shehia',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewMunicipal'),
                                'icon' => 'sun-o text-orange',
                                'items' => [
                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'label' => Yii::t('app', 'Add New Shehia'),
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createMunicipal'),
                                        'url' => ['/municipal/create'],
                                        'icon' => 'plus text-green',
                                    ],

                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'label' => Yii::t('app', 'Shehia List'),
                                        'url' => ['/municipal/index'],
                                        'icon' => 'circle text-green',
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Zones',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewStreet'),
                                'icon' => 'sun-o text-orange',
                                'items' => [
                                    [
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createStreet'),
                                        'label' => Yii::t('app', 'Add New Zone'),
                                        'url' => ['/street/create'],
                                        'icon' => 'plus text-green',
                                    ],

                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'label' => Yii::t('app', 'Street List'),
                                        'url' => ['/street/index'],
                                        'icon' => 'circle text-green',
                                    ],
                                ],
                            ],
                            [
                                //  'visible' =>  yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Work Area'),
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewWorkArea'),
                                'icon' => 'lock text-orange',
                                'items' => [
                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'label' => Yii::t('app', 'Add Wok Area'),
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createWorkArea'),
                                        'url' => ['/work-area/create'],
                                        'icon' => 'plus text-green',
                                    ],

                                    [
                                        //  'visible' =>  yii::$app->user->can('auditSystem'),
                                        'label' => Yii::t('app', 'Work Area Lists'),
                                        'url' => ['/work-area/index'],
                                        'icon' => 'circle text-green',
                                    ],
                                ],
                            ],

                        ],
                    ],

                    [
                        'label' => 'System Logs',
                        'visible' => Yii::$app->user->can('auditSystem') || Yii::$app->user->can('super_admin'),
                        'icon' => 'sun-o text-orange',
                        'items' => [

                            [
                                //'visible' => yii::$app->user->can('auditSystem'),
                                'label' => Yii::t('app', 'Audit Trail'),
                                'url' => ['/audit/index'],
                                'icon' => 'lock text-orange',
                            ],

                        ],
                    ],
                    [
                        'label' => 'System User',
                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                        'icon' => 'folder-open-o text-orange',
                        'url' => [''],
                        'items' => [
                            [
                                'label' => 'Super Admins',
                                'visible' => Yii::$app->user->can('super_admin'),
                                'icon' => 'user text-green',
                                'url' => ['/user/super-admin'],
                            ],

                            [
                                'label' => 'Admins',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                                'icon' => 'user text-green',
                                'url' => '',
                                'items' => [
                                    [
                                        'label' => 'New Admin',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createUser'),
                                        'icon' => 'plus text-green',
                                        'url' => ['/user/admin-create']
                                    ],
                                    [
                                        'label' => 'Admin List',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                                        'icon' => 'users text-green',
                                        'url' => ['/user/admin']
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Manager',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                                'icon' => 'user text-green',
                                'url' => '',
                                'items' => [
                                    [
                                        'label' => 'New Manager',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createUser'),
                                        'icon' => 'plus text-green',
                                        'url' => ['/user/manager-create']
                                    ],
                                    [
                                        'label' => 'Managers List',
                                        'icon' => 'users text-green',
                                        'url' => ['/user/managers-list']
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Accountant',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                                'icon' => 'user text-green',
                                'url' => '',
                                'items' => [
                                    [
                                        'label' => 'New Accountant',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createUser'),
                                        'icon' => 'plus text-green',
                                        'url' => ['/user/accountant-create']
                                    ],
                                    [
                                        'label' => 'Accoutant List',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createUser'),
                                        'icon' => 'users text-green',
                                        'url' => ['/user/accountant-list']
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Supervisors',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                                'icon' => 'user text-green',
                                'url' => '',
                                'items' => [
                                    [
                                        'label' => 'New Supervisor',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createUser'),
                                        'icon' => 'plus text-green',
                                        'url' => ['/user/supervisor-create']
                                    ],
                                    [
                                        'label' => 'Supervisor List',
                                        'icon' => 'users text-green',
                                        'url' => ['/user/supervisors-list']
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Clerks',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                                'icon' => 'users text-green',
                                'url' => '',
                                'items' => [
                                    [
                                        'label' => 'New Clerk',
                                        'icon' => 'plus text-green',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createUser'),
                                        'url' => ['/user/clerk-create']
                                    ],
                                    [
                                        'label' => 'Clerk List',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                                        'icon' => 'users text-green',
                                        'url' => ['/user/clerk']
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Government Officials',
                                'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                                'icon' => 'users text-green',
                                'url' => '',
                                'items' => [
                                    [
                                        'label' => 'New Agent',
                                        'icon' => 'plus text-green',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('createUser'),
                                        'url' => ['/user/gvt-create']
                                    ],
                                    [
                                        'label' => 'Officials List',
                                        'visible' => Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSystemUserModule'),
                                        'icon' => 'users text-green',
                                        'url' => ['/user/gvt']
                                    ],
                                ],
                            ],

                        ],
                    ],
                    [
                        'label' => 'Settings',
                        'visible' => (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSettingModule')),
                        'icon' => 'cogs text-orange',
                        'items' => [
                            ['label' => 'Day Amount Setup',
                                'icon' => 'cogs text-orange',
                                'url' => ['/day-amount-setup'],
                                'visible' => (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewAllUsers ')),
                            ],
                            ['label' => 'All Users',
                                'icon' => 'user text-orange',
                                'url' => ['/user'],
                                'visible' => (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewAllUsers ')),
                            ],

                            [
                                'visible' => (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSettingModule')),
                                'label' => Yii::t('app', 'Permissions List'),
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
                                'visible' => (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSettingModule')),
                                'label' => Yii::t('app', 'User Roles List'),
                                'url' => ['/role/index'],
                                'icon' => 'fa fa-lock text-orange',
                            ],
                            [
                                'label' => 'Assign Roles ',
                                'visible' => (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewSettingModule')),
                                'icon' => 'lock text-orange', 'url' => ['/auth-assignment'],
                            ],
                        ],
                    ],

                ],
            ]
        ) ?>
    </section>

</aside>

