<?php

namespace backend\controllers;

use backend\models\Application;
use backend\models\Audit;
use backend\models\ClerkDeni;
use backend\models\ClerkDeniSearch;
use backend\models\TicketTransactionSearch;
use common\models\LoginForm;
use kartik\grid\EditableColumnAction;
use Yii;
use backend\models\SupervisorDeni;
use backend\models\SupervisorDeniSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SupervisorDeniController implements the CRUD actions for SupervisorDeni model.
 */
class SupervisorDeniController extends Controller
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
     * Lists all SupervisorDeni models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('fungaSupervisorMahesabu')) {

                $searchModel = new SupervisorDeniSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia taarifa za madeni ya makaranni (Clerks) ', 'ClerkDeni', 'Index', '', '');

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


    public function actionSupervisorReport()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('fungaSupervisorMahesabu')) {

                $searchModel = new SupervisorDeniSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia ripoti za makaranni (Clerks) wote ', 'ClerkDeni', 'Index', '', '');

                return $this->render('indexSupervisor', [
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
     * Displays a single SupervisorDeni model.
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

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Creates a new SupervisorDeni model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('fungaSupervisorMahesabu') || Yii::$app->user->can('super_admin')) {
                $model = new SupervisorDeni();

                if ($model->load(Yii::$app->request->post())) {
                    $Cleck_Date = SupervisorDeniSearch::find()->select('collected_amount')->where(['name' => $model->name])->andWhere(['date(amount_date)' => $model->amount_date])->sum('collected_amount');
                    if ($Cleck_Date == '') {

                        $time = date('Y-m-d');
                        $time = strtotime($time);

                        $time1 = $model->amount_date;
                        $time1 = strtotime($time1);

                        if ($time1 <= $time) {
                            if ($model->amount_date != '' && $model->submitted_amount != '') {
                                $amount = ClerkDeniSearch::find()->select('collected_amount')->where(['created_by' => $model->name])->andWhere(['date(amount_date)' => $model->amount_date])->sum('collected_amount');
                                if ($amount !='') {
                                    if ($model->submitted_amount <= $amount) {
                                        $model->collected_amount = $amount;
                                        $model->deni = $model->collected_amount - $model->submitted_amount;
                                        $model->created_by = Yii::$app->user->identity->username;
                                        $model->created_at = date('Y-m-d H:i:s');
                                        Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') alifanikiwa kufunga mahesabu ya supervisor " ' . $model->user0->name . ' ")', 'ClerkDeni', 'Create', '', '');
                                        if ($model->deni == 0) {
                                            $model->status = SupervisorDeniSearch::COMPLETE;
                                            $model->save();
                                            Yii::$app->session->setFlash('', [
                                                'type' => 'success',
                                                'duration' => 4500,
                                                'icon' => 'fa fa-warning',
                                                'title' => 'Notification',
                                                'message' => 'Umefanikiwa kufunga Mahesabu- Status(COMPLETED)',
                                                'positonY' => 'top',
                                                'positonX' => 'right'
                                            ]);
                                        } else {
                                            $model->status = SupervisorDeniSearch::NOT_COMPLETE;
                                            $model->save();
                                            Yii::$app->session->setFlash('', [
                                                'type' => 'success',
                                                'duration' => 4500,
                                                'icon' => 'fa fa-warning',
                                                'title' => 'Notification',
                                                'message' => 'Umefanikiwa kufunga Mahesabu -status(NOT COMPLETED) ',
                                                'positonY' => 'top',
                                                'positonX' => 'right'
                                            ]);
                                        }

                                    } else {
                                        Yii::$app->session->setFlash('', [
                                            'type' => 'warning',
                                            'duration' => 4500,
                                            'icon' => 'fa fa-warning',
                                            'title' => 'Notification',
                                            'message' => 'Mahesabu yanayofungwa hayawezi zidi makusanyo ya siku husika',
                                            'positonY' => 'top',
                                            'positonX' => 'right'
                                        ]);
                                        return $this->redirect(['supervisor-deni/create']);
                                    }

                                }
                                else {
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'warning',
                                        'duration' => 4500,
                                        'icon' => 'fa fa-warning',
                                        'title' => 'Notification',
                                        'message' => 'Supervisor hana mahesabu ya kufungwa kwa tarehe hii',
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
                                    'message' => 'Date and Amount can not be empty',
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
                                'message' => 'Date can not be above today date',
                                'positonY' => 'top',
                                'positonX' => 'right'
                            ]);
                            Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') alijaribu kuongeza taarifa ya deni la karani (clerk) huyu " ' . $model->user0->name . ' " lakini hakufanikiwa kwakuwa tarehe aliyoweka ilikuwa ni nyuma zaidi ( haifanani na tarehe ya leo)', 'ClerkDeni', 'Create', '', '');
                            return $this->redirect(['supervisor-deni/create']);
                        }
                        return $this->redirect(['index']);
                    } else {
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 4500,
                            'icon' => 'fa fa-warning',
                            'title' => 'Notification',
                            'message' => 'Mahesabu ya supervisor uyu yamekwisha fungwa',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['supervisor-deni/create']);
                    }

                }

                return $this->render('create', [
                    'model' => $model,
                ]);

            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'Danger',
                    'duration' => 4500,
                    'icon' => 'fa fa-warning',
                    'title' => 'Notification',
                    'message' => 'Hauna uwezo wa kufunga mahesabu',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['supervisor-deni/create']);
            }


        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }




    /**
     * Updates an existing SupervisorDeni model.
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
     * Deletes an existing SupervisorDeni model.
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
     * Finds the SupervisorDeni model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SupervisorDeni the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SupervisorDeni::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionCollect1($id)
    {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->deni = $model->collected_amount - $model->submitted_amount;
            $model->status = SupervisorDeni::COMPLETE;
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->username;

            $model->save();
        }
        Yii::$app->session->setFlash('', [
            'type' => 'success',
            'duration' => 1500,
            'icon' => 'fa fa-check',
            'message' => 'Successfully rejected',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);


    }

    public function actions()
    {
        if (Yii::$app->user->can('super_admin')) {
            return ArrayHelper::merge(parent::actions(), [
                'collect' => [                                       // identifier for your editable action
                    'class' => EditableColumnAction::className(),     // action class name
                    'modelClass' => SupervisorDeni::className(),             // the update model class
                    'outputValue' => function ($model, $attribute, $key, $index) {

                        /*              $fmt = Yii::$app->formatter;
                                      $value = $model->$attribute;                 // your attribute value
                                      //    if ($attribute === 'submitted_amount') // selective validation by attribute
                                      //  {
                                      $model = $this->findModel($model->id);
                                      //  if ($model->submitted_amount === $model->collected_amount) {
                                      $model->deni = $model->collected_amount - $model->submitted_amount;
                                      $model->status = SupervisorDeni::COMPLETE;
                                      $model->updated_at = date('Y-m-d H:i:s');
                                      $model->updated_by = Yii::$app->user->identity->username;
                                      $model->save();*/
                        $fmt = Yii::$app->formatter;
                        $value = $model->$attribute;                 // your attribute value
                        $model = $this->findModel($model->id);
                        if ($model->submitted_amount <= $model->collected_amount) {           // selective validation by attribute
                            $model->deni = $model->collected_amount - $model->submitted_amount;     // return formatted value if desired
                     }
                        return '';
                    },
                    'outputMessage' => function ($model, $attribute, $key, $index) {
                        return '';                                  // any custom error after model save
                    },

                ],

            ]);
        }

    }
}
