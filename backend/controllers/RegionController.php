<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\User;
use common\models\LoginForm;
use Yii;
use backend\models\Region;
use backend\models\RegionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends Controller
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
     * Lists all Region models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new RegionSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            Audit::setActivity(Yii::$app->user->identity->name . ' was looking general information of regions ', 'Region ', 'index', '', '');
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single Region model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewRegion')) {
                $model = $this->findModel($id);

                Audit::setActivity(Yii::$app->user->identity->name . ' was looking the information of ' . $model->name.' region', 'Region', 'View', '', '');
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
     * Creates a new Region model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public
    function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('createRegion')) {
                $model = new Region();

                $model->created_at = date('y-m-d H:i:s');
                $model->created_by = Yii::$app->user->identity->username;

                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Audit::setActivity('New region ' . $model->name . ' was successfully created by ' . Yii::$app->user->identity->name, 'Region ', 'create', '', '');

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
     * Updates an existing Region model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('updateRegion')) {

                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'title'=>'Notification',
                        'icon' => 'fa fa-check',
                        'message' => 'Region was successfully updated',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);


                    Audit::setActivity('Region was successfully updated to ' . $model->name, 'Update ', 'Index', '', '');

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
            return $this->redirect(['site / login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Region model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {

            $model = $this->findModel($id);

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('deleteRegion')) {

                if ($this->findModel($id)->delete()) {

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'Region was successfully deleted',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    Audit::setActivity('The region ' . $model->name . ' was successfully deleted' . Yii::$app->user->identity->name, 'Region', 'Delete', '', '');

                    return $this->redirect(['index']);
                }

                return $this->redirect(['index']);
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
            return $this->redirect(['site / login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist . ');
    }
}
