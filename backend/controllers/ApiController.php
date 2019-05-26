<?php

namespace backend\controllers;


use backend\models\ClaimReport;
use backend\models\ClerkDeni;
use backend\models\ClerkDeniSearch;
use backend\models\Reference;
use backend\models\TicketTransaction;
use backend\models\User;
use backend\models\UserSearch;
use common\models\LoginForm;
use Yii;


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

        $model = new LoginForm();
        $params = Yii::$app->request->post();

        $model->username = $params['username'];
        $model->password = $params['password'];

        $user = User::findByUsername($model->username);
        $user_type = UserSearch::find()->where(['username' => $user])->one();

        if (!empty($user)) {
            if (($user_type['user_type'] === User::SUPERVISOR) || ($user_type['user_type'] === User::CLERK)) {
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
                $response['message'] = 'You do not have permissions';
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
        $sale->status = 0;
        $sale->receipt_no = Reference::findLast();
        // $sale->receipt_no = 'ABDFDS';

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

    public function actionFungaClerkMahesabu()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $sale = new ClerkDeni();
        $sale->attributes = \yii::$app->request->post();
        $sale->status=0;
        $sale->created_at = date('Y-m-d H:i:s');
        $sale->deni=$sale->collected_amount - $sale->submitted_amount;
        if ($sale->save()) {
            return array('status' => [
                'message' => 'Sent Successfully'
            ]
            );
        }
        else {
            return array('status ' => [
                $sale->getErrors(),
                'status' => '403',
            ]);
        }

    }

    public function actionClaimReport()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $claimReport = new ClaimReport();
        $claimReport->attributes = \yii::$app->request->post();

        $claimReport->created_at = date('Y-m-d H:i:s');

        if ($claimReport->save()) {
            return array('status' => [
                'message' => 'Sent Successfully'
            ]
            );
        }
        else {
            return array('status ' => [
                $claimReport->getErrors(),
                'status' => '403',
            ]);
        }

    }

}



