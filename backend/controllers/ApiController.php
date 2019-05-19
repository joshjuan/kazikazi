<?php

namespace backend\controllers;

use backend\models\AllExpenses;
use backend\models\AndroidUpdate;
use backend\models\Audit;
use backend\models\BenefitPerCar;
use backend\models\BenefitsAll;
use backend\models\CarExpenses;
use backend\models\CarOwners;
use backend\models\Cars;
use backend\models\CompanyExpenses;
use backend\models\Container;
use backend\models\ContainerSize;
use backend\models\Demo;
use backend\models\Driver;
use backend\models\Employees;
use backend\models\ExpensesPerCar;
use backend\models\From;
use backend\models\IncomeSources;
use backend\models\Loans;
use backend\models\LoginForm;
use backend\models\Notification;
use backend\models\OfficeMaintenance;
use backend\models\PartTime;
use backend\models\PartTimeStarf;
use backend\models\PersonalExpenses;
use backend\models\PersonalInvestment;
use backend\models\PersonalTaken;
use backend\models\Salary;
use backend\models\Status;
use backend\models\Tandiboy;
use backend\models\TransportFees;
use backend\models\TransportPerCar;
use backend\models\WaitingCharges;
use Yii;
use yii\data\ActiveDataProvider;
use backend\models\UserLoginDetails;


class ApiController extends \yii\rest\ActiveController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public $modelClass = 'backend\models\User';




    public function actionLogin()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $model = new \common\models\LoginForm();
        $params = Yii::$app->request->post();

        $model->username = $params['username'];
        $model->password = $params['password'];

        $user = \backend\models\User::findByUsername($model->username);

        if (!empty($user)) {

            if ($model->login()) {
                $response['error'] = false;
                $response['status'] = 'success';
                $response['message'] = 'You are now logged in';
                $response['user'] = \common\models\User::findByUsername($model->username);
                //return [$response,$model];
                return $response;
            } else {
                $response['error'] = false;
                $response['status'] = 'error';
                $model->validate($model->password);
                $response['errors'] = $model->getErrors();
                $response['message'] = 'wrong password';
                return $response;
            }
        } else {
            $response['error'] = false;
            $response['status'] = 'error';
            $model->validate($model->password);
            $response['errors'] = $model->getErrors();
            $response['message'] = 'user is disabled or does not exist!';
            return $response;
        }
    }


}



