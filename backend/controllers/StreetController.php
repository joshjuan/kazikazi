<?php

namespace backend\controllers;

use backend\models\Audit;
use common\models\LoginForm;
use Egulias\EmailValidator\EmailLexer;
use Yii;
use backend\models\Street;
use backend\models\StreetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StreetController implements the CRUD actions for Street model.
 */
class StreetController extends Controller
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
     * Lists all Street models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewStreet')) {

                $searchModel = new StreetSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia taarifa za zoni zote kwa ujumla. ', 'Street', 'Index', '', '');

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'title' => 'Notification',
                    'icon' => 'fa fa-warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['site/index']);
            }



        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Displays a single Street model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('viewStreet')) {

                $model = $this->findModel($id);

                Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameangalia taarifa ya zoni, ambayo ni " ' . $model->name . ' ".', 'Street', 'View', '', '');

                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);

            }else{
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

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Street model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('createStreet')) {

                $model = new Street();
                $model->created_at=date('y-m-d H:i:s');
                $model->created_by=Yii::$app->user->identity->username;

                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') ameongeza zoni mpya, ambayo ni " ' . $model->name . ' ".', 'Street', 'Create', '', '');

                    return $this->redirect(['view', 'id' => $model->id]);
                }

                return $this->render('create', [
                    'model' => $model,
                ]);

            }else{
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

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Street model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('updateStreet')) {


                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'title'=>'Notification',
                        'message' => 'District was successfully updated',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);


                    Audit::setActivity(Yii::$app->user->identity->name . ' ( ' . Yii::$app->user->identity->role . ') amebadilisha taarifa ya zoni, ambayo ni " ' . $model->name . ' ".', 'Street', 'Update', '', '');

                    return $this->redirect(['view', 'id' => $model->id]);
                }

                return $this->render('update', [
                    'model' => $model,
                ]);

            }else{
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

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Street model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin')) {

                $model = $this->findModel($id);

                if ($this->findModel($id)->delete()) {

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'Zone was successfully deleted',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    Audit::setActivity('Zone ' . $model->name . ' was successfully deleted' . Yii::$app->user->identity->name, 'Street', 'Delete', '', '');

                    return $this->redirect(['index']);
                }

            } else{
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

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Finds the Street model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Street the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Street::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
