<?php

namespace app\modules\user\controllers;

use Yii;

use backend\models\User;
use backend\models\UserSearch;


use common\models\AuthItem;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
USE yii\web\ForbiddenHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class AdminController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'index', 'delete', 'view','logout', 'reactivate'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        if(!Yii::$app->user->can(AuthItem::READ_ADMIN)){
            throw new ForbiddenHttpException();
        } 
        $searchModel = new UserSearch();
        $params = Yii::$app->request->queryParams;
        $params['UserSearch']['user_rol'] = 'admin';

        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->can(AuthItem::READ_ADMIN)){
            throw new ForbiddenHttpException();
        } 
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can(AuthItem::CREATE_ADMIN)){
            throw new ForbiddenHttpException();
        } 
        $model = new User();
        $model->user_rol = 'admin';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('../../../../views/user/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can(AuthItem::UPDATE_ADMIN)){
            throw new ForbiddenHttpException();
        } 
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('../../../../views/user/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can(AuthItem::DISABLE_ADMIN)){
            throw new ForbiddenHttpException();
        } 
        $model = $this->findModel($id);
        $model->status = User::STATUS_DELETED;
        $model->save();
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionReactivate($id)
    {
        if(!Yii::$app->user->can(AuthItem::ENABLE_ADMIN)){
            throw new ForbiddenHttpException();
        } 
        $model = $this->findModel($id);
        $model->status = User::STATUS_ACTIVE;
        $model->save();
        return $this->redirect(['view', 'id' => $id]);
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
