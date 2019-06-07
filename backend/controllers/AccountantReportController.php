<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\ClerkDeni;
use backend\models\ClerkDeniSearch;
use backend\models\SupervisorDeni;
use backend\models\SupervisorDeniSearch;
use backend\models\TicketTransactionSearch;
use common\models\LoginForm;
use kartik\grid\EditableColumnAction;
use Yii;
use backend\models\AccountantReport;
use backend\models\AccountantReportSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AccountantReportController implements the CRUD actions for AccountantReport model.
 */
class AccountantReportController extends Controller
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
     * Lists all AccountantReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewReportModule')) {
            $searchModel = new AccountantReportSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else {
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
    }
    public function actionReport()
    {
        if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewReportModule')) {



            $searchModel = new AccountantReportSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('report', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else {
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
    }

    /**
     * Displays a single AccountantReport model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AccountantReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('createAccountantMahesabuModule')) {


                $model = new AccountantReport();

                if ($model->load(Yii::$app->request->post())) {
                    if ($model->collected_date != '') {

                        $collected_amount = TicketTransactionSearch::find()->select('amount')->andWhere(['date(create_at)' => $model->collected_date])->sum('amount');
                        if ($collected_amount != '') {
                            $collected_date = AccountantReport::find()->select('collected_amount')->andWhere(['date(collected_date)' => $model->collected_date])->sum('collected_amount');
                            if ($collected_date == '') {

                                if ($model->submitted_amount <= $collected_amount) {

                                    $time = date('Y-m-d');
                                    $time = strtotime($time);

                                    $time1 = $model->collected_date;
                                    $time1 = strtotime($time1);

                                    if ($time1 <= $time) {
                                        $model->collected_amount = $collected_amount;
                                        $model->difference = $model->collected_amount - $model->submitted_amount;
                                        $model->created_at = date('Y-m-d H:i:s');
                                        $model->created_by = Yii::$app->user->identity->name;
                                        $model->report_no = date('Ymd');
                                        $model->save();
                                        Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') amefunga mahesabu ya siku kwa tarehe" ' . $model->collected_date . ' ")', 'AccountantReport', 'Create', '', '');
                                    } else {
                                        Yii::$app->session->setFlash('', [
                                            'type' => 'warning',
                                            'duration' => 4500,
                                            'icon' => 'fa fa-warning',
                                            'title' => 'Notification',
                                            'message' => 'Tarehe ya kufunga mahesabu haiwezi kuwa mbele zaid tarehe ya siku ya leo',
                                            'positonY' => 'top',
                                            'positonX' => 'right'
                                        ]);

                                        return $this->redirect(['supervisor-deni/create']);
                                    }
                                } else {
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'warning',
                                        'duration' => 4500,
                                        'icon' => 'fa fa-warning',
                                        'title' => 'Notification',
                                        'message' => 'Pesa iliyo letwa inazid makusanyo ya tarehe hii',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                    return $this->redirect(['accountant-report/create']);
                                }


                            } else {
                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 4500,
                                    'icon' => 'fa fa-warning',
                                    'title' => 'Notification',
                                    'message' => 'Mahesabu ya tarehe hii yemakwisha fungwa',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                return $this->redirect(['accountant-report/create']);
                            }


                        } else {
                            Yii::$app->session->setFlash('', [
                                'type' => 'warning',
                                'duration' => 4500,
                                'icon' => 'fa fa-warning',
                                'title' => 'Notification',
                                'message' => 'Hakuna Makusanyo katika siku hii',
                                'positonY' => 'top',
                                'positonX' => 'right'
                            ]);
                            return $this->redirect(['accountant-report/create']);
                        }
                        return $this->redirect(['index']);
                    } else {

                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 4500,
                            'icon' => 'fa fa-warning',
                            'title' => 'Notification',
                            'message' => 'Tarehe husika haiwez kuwa wazi',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['accountant-report/create']);
                    }

                }

                return $this->render('create', [
                    'model' => $model,
                ]);
            }

            else {
                Yii::$app->session->setFlash('', [
                    'type' => 'Danger',
                    'duration' => 4500,
                    'icon' => 'fa fa-warning',
                    'title' => 'Notification',
                    'message' => 'Hauna uwezo wa kufunga mahesabu',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['accountant-report/index']);
            }

        }
        else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionUploadSlip($id)
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('createAccountantMahesabuModule')) {
                $model = $this->findModel($id);
                $file = new AccountantReport();
                $model->updated_by = Yii::$app->user->identity->name;
                $model->updated_at = date('Y-m-d H:i:s');
                $model->report_status = SupervisorDeni::CLOSED;
                $model->receipt_no = $_POST['AccountantReport']['receipt_no'];

                if ($model->load(Yii::$app->request->post())) {
                    $model->file = UploadedFile::getInstance($model, 'file');

                    if ($model->file !='') {

                        $model->file = UploadedFile::getInstance($model, 'file');
                        $model->file->saveAs('documents/' . 'PAYSLIP-' . date('YmdHi') . '.' . $model->file->extension);
                        $model->uploaded_receipt = 'PAYSLIP-' . date('YmdHi') . '.' . $model->file->extension;
                        $model->save();

                    }
                    else{
                        $model->save();
                    }
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 4500,
                        'icon' => 'fa fa-warning',
                        'title' => 'Notification',
                        'message' => 'Umefankiwa ku upload pay slip document',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['supervisor-deni/index']);
                }
                else{
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 4500,
                        'icon' => 'fa fa-warning',
                        'title' => 'Notification',
                        'message' => 'Fail',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                }

                return $this->render('update', [
                    'model' => $model,
                ]);
            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 2000,
                    'icon' => 'fa fa-check',
                    'message' => 'You do not have permission to change upload Invoice',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['view', 'id' => $id]);
            }
        }
        else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }


    }

    public function actionGvtReport()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('governmentOfficial')) {

                $searchModel = new AccountantReportSearch();
                $dataProvider = $searchModel->searchGvt(Yii::$app->request->queryParams);

                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia ripoti za makaranni (Clerks) wote ', 'ClerkDeni', 'Index', '', '');

                return $this->render('indexGvt', [
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
     * Updates an existing AccountantReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AccountantReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AccountantReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccountantReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccountantReport::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



}
