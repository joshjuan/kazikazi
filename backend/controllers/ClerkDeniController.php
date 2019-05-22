<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\TicketTransaction;
use backend\models\TicketTransactionSearch;
use common\models\LoginForm;
use kartik\grid\EditableColumnAction;
use Yii;
use backend\models\ClerkDeni;
use backend\models\ClerkDeniSearch;
use yii\db\Transaction;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClerkDeniController implements the CRUD actions for ClerkDeni model.
 */
class ClerkDeniController extends Controller
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
     * Lists all ClerkDeni models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('fungaClerkMahesabu')) {

                $searchModel = new ClerkDeniSearch();
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

    public function actionClerkReport()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewClerkMahesabu')) {

                $searchModel = new ClerkDeniSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia ripoti za makaranni (Clerks) wote ', 'ClerkDeni', 'Index', '', '');

                return $this->render('indexClerk', [
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
     * Displays a single ClerkDeni model.
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
     * Creates a new ClerkDeni model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('fungaClerkMahesabu') || Yii::$app->user->can('super_admin')){
                $model = new ClerkDeni();

                if ($model->load(Yii::$app->request->post())) {
                    $Cleck_Date = ClerkDeniSearch::find()->select('collected_amount')->where(['name' => $model->name])->andWhere(['date(amount_date)' => $model->amount_date])->sum('collected_amount');
                    if ($Cleck_Date == '') {

                        $time = date('Y-m-d');
                        $time = strtotime($time);

                        $time1 = $model->amount_date;
                        $time1 = strtotime($time1);

                        if ($time1 <= $time) {
                            if ($model->amount_date != '' && $model->submitted_amount != '') {
                                $amount = TicketTransactionSearch::find()->select('amount')->where(['user' => $model->name])->andWhere(['date(create_at)' => $model->amount_date])->sum('amount');
                                if ($amount != '') {
                                    $model->collected_amount = $amount;
                                    $model->deni = $model->collected_amount - $model->submitted_amount;
                                    $model->created_by = Yii::$app->user->identity->username;
                                    $model->created_at = date('Y-m-d H:i:s');
                                    Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') alifanikiwa kufunga mahesabu ya karani " ' . $model->user0->name . ' ")', 'ClerkDeni', 'Create', '', '');
                                    if ($model->deni == 0) {
                                        $model->status = ClerkDeni::COMPLETE;
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
                                        $model->status = ClerkDeni::NOT_COMPLETE;
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
                                        'message' => 'Karani hana mahesabu ya kufungwa kwa tarehe hii',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                    return $this->redirect(['clerk-deni/create']);
                                }

                            }
                            else {
                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 4500,
                                    'icon' => 'fa fa-warning',
                                    'title' => 'Notification',
                                    'message' => 'Date and Amount can not be empty',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                return $this->redirect(['clerk-deni/create']);
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
                            return $this->redirect(['clerk-deni/create']);
                        }
                        return $this->redirect(['index']);
                    } else {
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 4500,
                            'icon' => 'fa fa-warning',
                            'title' => 'Notification',
                            'message' => 'Mahesabu ya karani uyu yamekwisha fungwa',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['clerk-deni/create']);
                    }

                }

                return $this->render('create', [
                    'model' => $model,
                ]);

            }
            else
            {
                Yii::$app->session->setFlash('', [
                    'type' => 'Danger',
                    'duration' => 4500,
                    'icon' => 'fa fa-warning',
                    'title' => 'Notification',
                    'message' => 'Hauna uwezo wa kufunga mahesabu',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['clerk-deni/create']);
            }


        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing ClerkDeni model.
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
     * Deletes an existing ClerkDeni model.
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
     * Finds the ClerkDeni model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClerkDeni the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClerkDeni::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'collect' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => ClerkDeni::className(),             // the update model class
                'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'submitted_amount') // selective validation by attribute
                    {
                        $model = $this->findModel($model->id);
                        if ($model->submitted_amount === $model->collected_amount) {
                            $model->deni = $model->collected_amount - $model->submitted_amount;
                            $model->status = ClerkDeni::COMPLETE;
                            $model->updated_at=date('Y-m-d H:i:s');
                            $model->updated_by=Yii::$app->user->identity->username;
                            $model->save();
                        }

                    }
                    return '';                                   // empty is same as $value
                },
                'outputMessage' => function ($model, $attribute, $key, $index) {
                    return '';                                  // any custom error after model save
                },

            ],

        ]);

    }
}

