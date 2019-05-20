<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\District;
use backend\models\FansRequestSearch;
use backend\models\Municipal;
use backend\models\Region;
use backend\models\WorkArea;
use backend\models\WorkAreaSearch;
use common\models\LoginForm;
use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        Audit::setActivity('Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionManagersList()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->searchManager(Yii::$app->request->queryParams);

        Audit::setActivity('Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '');
        return $this->render('managers', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSupervisorsList()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->searchSupervisor(Yii::$app->request->queryParams);

        Audit::setActivity('Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '');
        return $this->render('supervisor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSuperAdmin()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super-admin')) {

                $searchModel = new UserSearch();
                $dataProvider = $searchModel->searchSuperAdmin(Yii::$app->request->queryParams);

                Audit::setActivity('Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '');
                return $this->render('super_admin', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

            }
            else
            {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'icon' => 'fa fa-warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }


    }


    public function actionAdmin()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')) {

                $searchModel = new UserSearch();
                $dataProvider = $searchModel->searchAdmin(Yii::$app->request->queryParams);

                Audit::setActivity('Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '');
                return $this->render('admin', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

            }
            else
            {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'icon' => 'fa fa-warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }


    }

    public function actionClerk()
    {
        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')) {

                $searchModel = new UserSearch();
                $dataProvider = $searchModel->searchClerk(Yii::$app->request->queryParams);

                Audit::setActivity('Ameangalia orodha ya watumiaji wa mfumo ', 'User ', 'Index', '', '');
                return $this->render('admin', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

            }
            else
            {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'icon' => 'fa fa-warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }


    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);


        Audit::setActivity('Ameangalia taarifa ya ' . $model->name . ', namba zake ni ' . $model->mobile, 'User', 'View', '', '');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionClerkCreate()
    {

        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')) {
                $model = new User();

                //  $model->scenario = 'createUser';
                $model->user_type=User::CLERK;


                if ($model->load(Yii::$app->request->post())) {
                    $amount = WorkAreaSearch::find()->select('amount')->where(['id' => $model->work_area])->one();;
                    $model->amount=intval($amount['amount']);
                    Audit::setActivity('New data clerk successfully created ', 'Clerk ', 'Index', '', '');
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else
            {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'icon' => 'fa fa-warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }


        return $this->render('create-clerk', [
            'model' => $model,
        ]);

        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }
    public function actionSupervisorCreate()
    {

        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')) {
                $model = new User();

                //  $model->scenario = 'createUser';

                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Audit::setActivity('New system user successfully created ', 'User ', 'Index', '', '');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else
            {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'icon' => 'fa fa-warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }


        return $this->render('create-supervisor', [
            'model' => $model,
        ]);

        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionRegionList($id){

            $count = District::find()
                ->where(['region'=>$id,])
                ->count();

            $cities = District::find()
                ->where(['region'=>$id])
                ->orderBy('id DESC')
                ->all();

            if($count > 0){
                foreach($cities as $city){
                    echo "<option value='".$city->id."'>".$city->name."</option>";
                }
            }else{
                echo "<option>-</option>";
            }

    }
    public function actionDistrictList($id){

            $count = Municipal::find()
                ->where(['district'=>$id,])
                ->count();

            $cities = Municipal::find()
                ->where(['district'=>$id])
                ->orderBy('id DESC')
                ->all();

            if($count > 0){
                foreach($cities as $city){
                    echo "<option value='".$city->id."'>".$city->name."</option>";
                }
            }else{
                echo "<option>-</option>";
            }

    }
    public function actionAdminCreate()
    {

        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')) {
                $model = new User();

                //  $model->scenario = 'createUser';
                    $model->user_type=User::ADMIN;
                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Audit::setActivity('New system user successfully created ', 'User ', 'Index', '', '');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else
            {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'icon' => 'fa fa-warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }


        return $this->render('create-admin', [
            'model' => $model,
        ]);

        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }
    public function actionManagerCreate()
    {

        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->can('super_admin') || Yii::$app->user->can('admin')) {
                $model = new User();

                //  $model->scenario = 'createUser';

                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Audit::setActivity('New system user successfully created ', 'User ', 'Index', '', '');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else
            {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 3500,
                    'icon' => 'fa fa-warning',
                    'message' => 'You do not have permission',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['site/index']);
            }


        return $this->render('create-manager', [
            'model' => $model,
        ]);

        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }



    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario="admin-update";

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionProfile()
    {
        if (!Yii::$app->user->isGuest) {
            $id = Yii::$app->user->identity->id;
            $model = $this->findModel($id);

            //$emp = $this->findEmpModel($model->emp_id);
            $model->setScenario('admin-update');
            if ($model->load(Yii::$app->request->post())) {
                //   Yii::$app->authManager->revokeAll($id);
                //  Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $id);
                $model->save();

                Yii::$app->getSession()->setFlash(' ', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'fa fa-check',
                    'message' => 'You have successfully changed your password.',
                    'title' => 'Notification ....!!',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['profile', 'id' => $model->id]);

            } else {
                return $this->render('profile', [
                    'model' => $this->findModel($id),
                ]);
            }

        } else {
            $model = new LoginForm();
            return $this->render('site/login', [
                'model' => $model,
            ]);
        }
    }
}
