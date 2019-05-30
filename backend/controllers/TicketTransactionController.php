<?php

namespace backend\controllers;

use backend\models\AccountantReport;
use backend\models\Audit;
use common\models\LoginForm;
use kartik\mpdf\Pdf;
use Yii;
use backend\models\TicketTransaction;
use backend\models\TicketTransactionSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketTransactionController implements the CRUD actions for TicketTransaction model.
 */
class TicketTransactionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TicketTransaction models.
     * @return mixed
     */

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewTicket')) {

                $model = new Model;
                $searchModel = new TicketTransactionSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia taarifa za ticket transaction ', 'TicketTransaction', 'Index', '', '');

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'title' => 'Notification',
                    'message' => Yii::t('app', 'You dont have a permission'),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionAccountantIndex()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('accountant')) {

                $model = new Model;
                $searchModel = new TicketTransactionSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia taarifa za ticket transaction ', 'TicketTransaction', 'Index', '', '');

                return $this->render('indexAccountant', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'title' => 'Notification',
                    'message' => Yii::t('app', 'You dont have a permission'),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionGovernmentIndex()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('governmentOfficial')) {

                $model = new Model;
                $searchModel = new TicketTransactionSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia taarifa za ticket transaction ', 'TicketTransaction', 'Index', '', '');

                return $this->render('indexGovt', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'title' => 'Notification',
                    'message' => Yii::t('app', 'You dont have a permission'),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single TicketTransaction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Creates a new TicketTransaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {

            $model = new TicketTransaction();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing TicketTransaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {

            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing TicketTransaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Finds the TicketTransaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TicketTransaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TicketTransaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionDateRange()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new TicketTransactionSearch();
            $dataProvider = $searchModel->searchDateRange(Yii::$app->request->queryParams);

            return $this->render('date_range', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionClerkReport()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new TicketTransactionSearch();
            $dataProvider = $searchModel->searchClerk(Yii::$app->request->queryParams);

            Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia ripoti za makarani (clerks) wote ', 'TicketTransaction', 'View', '', '');

            return $this->render('clerks_report', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionSupervisorReport()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new TicketTransactionSearch();
            $dataProvider = $searchModel->searchSupervisor(Yii::$app->request->queryParams);

            Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia ripoti za makarani (clerks) wote ', 'TicketTransaction', 'View', '', '');

            return $this->render('clerks_report', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionClerkDeni()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new TicketTransactionSearch();
            $dataProvider = $searchModel->searchClerk(Yii::$app->request->queryParams);

            return $this->render('clerks_deni1', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionPrint($id)
    {
        if (!Yii::$app->user->isGuest) {
          //  $currentBudget = Budget::getCurrentBudget(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id));
         //   if($currentBudget != null) {
            $date = AccountantReport::find()->select(['date(collected_date)'])->where(['id' =>$id])->one();
            $tickets = TicketTransaction::find()->where(['date(create_at)'=>$date])->all();
                //$malipo->asArray()->all();
                if ($tickets != null) {

                    // print_r($malipo);
                    //exit;
                    $pdf = new Pdf([
                        'mode' => Pdf::DEST_DOWNLOAD, // leaner size using standard fonts
                        'content' => $this->renderPartial('print', [
                            'tickets' => $tickets
                        ]),
                        'options' => [
                            'title' => 'Privacy Policy - Krajee.com',
                            'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                        ],
                        'methods' => [
                            'SetHeader' => ['  ||Generated On: ' . date("Y-m-d H:i")],
                            'SetFooter' => ['| |Page {PAGENO}|'],
                        ]
                    ]);
                    return $pdf->render();
                    exit;

                }
          //  }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }
}
