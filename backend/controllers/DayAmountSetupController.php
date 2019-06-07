<?php

namespace backend\controllers;

use Yii;
use backend\models\DayAmountSetup;
use backend\models\DayAmountSetupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DayAmountSetupController implements the CRUD actions for DayAmountSetup model.
 */
class DayAmountSetupController extends Controller
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
     * Lists all DayAmountSetup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DayAmountSetupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DayAmountSetup model.
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
     * Creates a new DayAmountSetup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')){


        $model = new DayAmountSetup();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_by=Yii::$app->user->identity->username;
            $model->created_at=date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
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

            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing DayAmountSetup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')){
            $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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

        return $this->redirect(['index']);
    }
    }

    /**
     * Deletes an existing DayAmountSetup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('NO-ONE')){
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
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

            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the DayAmountSetup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DayAmountSetup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DayAmountSetup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
