<?php

namespace backend\controllers;

use Yii;
use backend\models\Lending;
use backend\models\LendingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LendingController implements the CRUD actions for Lending model.
 */
class LendingController extends Controller
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
     * Lists all Lending models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LendingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lending model.
     * @param integer $user_id
     * @param integer $copy_id
     * @return mixed
     */
    public function actionView($user_id, $copy_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $copy_id),
        ]);
    }

    /**
     * Creates a new Lending model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lending();

        if ($model->load(Yii::$app->request->post())) {
            $model->lend_auth_at=date('Y-m-d');
            $model->save();
            $copy = \backend\models\Copy::find()->where(['copy_id'=>$model->copy_id])->one();
            $copy->copy_available = "Ocupado";
            $copy->update();
            return $this->redirect(['view', 'user_id' => $model->user_id, 'copy_id' => $model->copy_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Lending model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $copy_id
     * @return mixed
     */
    public function actionUpdate($user_id, $copy_id)
    {
        $model = $this->findModel($user_id, $copy_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'copy_id' => $model->copy_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Lending model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $copy_id
     * @return mixed
     */
    public function actionDelete($user_id, $copy_id)
    {
        $this->findModel($user_id, $copy_id)->delete();

        return $this->redirect(['index']);
    }

    public function actionReturn($copy, $user)
    {
        $lend = Lending::findOne(['copy_id' => $copy, 'user_id' => $user]);

        if(!$lend->lend_return_real){
            $lend->lend_return_real = date_format(date_create(), 'Y-m-d H:m:s');
            $lend->save();
        }
        print_r($lend->lend_return_at . ' ' . $user);
    }

    /**
     * Finds the Lending model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $copy_id
     * @return Lending the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $copy_id)
    {
        if (($model = Lending::findOne(['user_id' => $user_id, 'copy_id' => $copy_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
