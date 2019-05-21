<?php

namespace backend\controllers;


use backend\models\ClerkDeni;
use backend\models\ClerkDeniSearch;
use backend\models\FansRequest;
use backend\models\FansRequestSearch;
use backend\models\NotificationsSearch;
use backend\models\Reference;
use backend\models\SalesTransactions;
use backend\models\TicketTransaction;
use backend\models\User;
use backend\models\UserSearch;
use backend\models\WorkArea;
use backend\models\WorkAreaSearch;
use Yii;
use yii\db\Query;

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

    public function actionDeni()
    {

        $params = Yii::$app->request->post();
        $name = $params['user_id'];
        $amount = ClerkDeniSearch::find()->where(['name' => $name])->sum('deni');
        if ($amount != '') {
            return array(
                'deni' => $amount,
            );
        } else {
            return array('statusCode ' => [
               // $amount->getErrors(),
                'status' => 'No results',
            ]);

        }
    }

    public function actionCollection()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $sale = new TicketTransaction();
        $sale->attributes = \yii::$app->request->post();
      //  $sale->create_at = date('Y-m-d');
       // $sale->created_by = Yii::$app->user->identity->username;
        $sale->status=0;
        $sale->receipt_no = Reference::findLast();

        if ($sale->validate()) {
            $sale->save();
            return array('receipt' => [
                'reference_no' => $sale->ref_no,
                'receipt_number' => $sale->receipt_no,
                'status' => '200'
            ]);
        } else {
            return array('statusCode ' => [
                $sale->getErrors(),
                'status' => '403',
            ]);

        }
    }


}



