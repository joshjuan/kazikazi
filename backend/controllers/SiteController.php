<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\User;
use backend\models\UserLoginDetails;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('super_admin')) {

            return $this->render('index');

        } elseif (Yii::$app->user->can('admin')) {

            return $this->render('indexAdministrator');

        } elseif (Yii::$app->user->can('manager')) {

            return $this->render('indexManager');
        }
        elseif (Yii::$app->user->can('clerk')) {

            return $this->render('indexClerk');
        }
        else{
            return $this->render('default');
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }
        else {

            $model = new LoginForm();

            if ($model->load(Yii::$app->request->post()) && $model->login()) {

                if (Yii::$app->user->identity->role != ''){
                    if (\Yii::$app->user->identity->role == 'super_admin' || \Yii::$app->user->identity->role == 'admin' || \Yii::$app->user->identity->role == 'manager' || \Yii::$app->user->identity->role == 'accountant' || \Yii::$app->user->identity->role == 'government_official') {

                        Audit::setActivity('New Login at ' . date('Y-m-d H:i:s'), 'ULG', 'Login', '', '');

                        Yii::$app->session->setFlash('', [
                            'type' => 'success',
                            'duration' => 6000,
                            'icon' => 'fa fa-check',
                            'title' => 'Notification',
                            'message' => Yii::$app->user->identity->name . ', Last Login at: ' . Yii::$app->user->identity->last_login,
                            'positonY' => 'top',
                            'positonX' => 'center'
                        ]);

                        User::updateAll(['last_login' => date('Y-m-d H:i:s'),], ['username' => Yii::$app->user->identity->username]);
                        return $this->goBack();

                    }
                    else {
                        Yii::$app->user->logout();

                        Yii::$app->session->setFlash('failure', "You do not have permission to login, contact System Admin");

                        return $this->render('login', [
                            'model' => $model,
                        ]);

                        //redirect again page to login form.
                        return $this->redirect(['site/login']);
                    }
            }
                else {
                    Yii::$app->user->logout();

                    Yii::$app->session->setFlash('failure', "Contact System Admin So that you can be assigned a role");

                    return $this->render('login', [
                        'model' => $model,
                    ]);

                    //redirect again page to login form.
                    return $this->redirect(['site/login']);
                }

            } else {

                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }

    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        //User::updateAll(['username' => Yii::$app->user->identity->username]);
        Audit::setActivity(Yii::$app->user->identity->username . ' Logout at ' . date('Y-m-d H:i:s'), 'ULG', 'Logout', '', '');
        Yii::$app->user->logout();
        return $this->goHome();
    }
}

