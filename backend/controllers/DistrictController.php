<?php

namespace backend\controllers;

use backend\models\Audit;
use common\models\LoginForm;
use Yii;
use backend\models\District;
use backend\models\DistrictSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DistrictController implements the CRUD actions for District model.
 */
class DistrictController extends Controller
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
     * Lists all District models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewDistrict')) {

                $searchModel = new DistrictSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia taarifa za wilaya yote kwa ujumla. ', 'District', 'Index', '', '');

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'icon' => 'fa fa-warning',
                    'title' => 'Notification',
                    'message' => 'You do not have permission',
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
     * Displays a single District model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {

            $model = $this->findModel($id);

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewDistrict')) {

                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia taarifa ya wilaya ya " ' . $model->name . ' ".', 'District', 'View', '', '');

                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);

            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'icon' => 'fa fa-warning',
                    'title' => 'Notification',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
             //   Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') amejaribu kuangalia taarifa ya wilaya ya " ' . $model->name . ' " lakina hakufanikiwa kwakuwa hakuwa na ruhusa ya kuangalia hiyo taarifa.', 'District', 'View', '', '');
                return $this->redirect(['index']);
            }


        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new District model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('createDistrict')) {

                $model = new District();
                $model->create_at = date('y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->username;

                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameongeza wilaya mpya, ambayo ni " ' . $model->name . ' ".', 'District', 'Create', '', '');

                    return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('create', [
                    'model' => $model,
                ]);

            } else {

                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'title' => 'Notification',
                    'icon' => 'fa fa-warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['index']);

            }

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }


    }

    /**
     * Updates an existing District model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('updateDistrict')) {

                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'title' => 'Notification',
                        'message' => 'District was successfully updated',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);


                    Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') amebadilisha taarifa ya wilaya ya " ' . $model->name . ' ".', 'District', 'Update', '', '');
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                return $this->render('update', [
                    'model' => $model,
                ]);

            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'title' => 'Notification',
                    'icon' => 'fa fa - warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
            }

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing District model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') ) {

                $model = $this->findModel($id);

                if ($this->findModel($id)->delete()) {

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'District was successfully deleted',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    Audit::setActivity('The region ' . $model->name . ' was successfully deleted' . Yii::$app->user->identity->name, 'Region', 'Delete', '', '');

                    return $this->redirect(['district\index']);
                }

            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'title' => 'Notification',
                    'icon' => 'fa fa - warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['district/index']);
            }

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the District model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return District the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = District::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
