<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Lending;
use frontend\models\LendingSearch;
use backend\models\Copy;
use backend\models\Book;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LendingController implements the CRUD actions for Lending model.
 */
class LendingController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
    public function actionIndex() {
        $id = Yii::$app->user->identity->id;
        $lendings = Lending::find()->where(['user_id' => $id])->all();
        $events;
        foreach ($lendings as $key => $lending) {
            $event = new \yii2fullcalendar\models\Event();
            $copy = Copy::find()->where(['copy_id'=>$lending->copy_id])->one();
            $book = Book::find()->where(['book_id'=>$copy->book_id])->one();
            $event->id = $lending->lending_id;
            $event->title = substr($book->book_title,0,20);
            $event->start = date('Y-m-d\TH:i:s\Z', strtotime($lending->lend_auth_at));
            $event->end = date('Y-m-d\TH:i:s\Z', strtotime($lending->lend_return_at));
            $url = \yii\helpers\Url::toRoute([
                'lending/view', 
                'lending_id'=>$lending->lending_id,
                'user_id'=>$lending->user_id, 
                'copy_id'=>$lending->copy_id]);
            $event->url= $url;
            $events[] = $event; 
        }
        return $this->render('index', [
                    'events' => $events
        ]);
    }

    /**
     * Displays a single Lending model.
     * @param integer $lending_id
     * @param integer $user_id
     * @param string $copy_id
     * @return mixed
     */
    public function actionView($lending_id, $user_id, $copy_id) {
        return $this->render('view', [
                    'model' => $this->findModel($lending_id, $user_id, $copy_id),
        ]);
    }

    /**
     * Creates a new Lending model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Lending();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'lending_id' => $model->lending_id, 'user_id' => $model->user_id, 'copy_id' => $model->copy_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Lending model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $lending_id
     * @param integer $user_id
     * @param string $copy_id
     * @return mixed
     */
    public function actionUpdate($lending_id, $user_id, $copy_id) {
        $model = $this->findModel($lending_id, $user_id, $copy_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'lending_id' => $model->lending_id, 'user_id' => $model->user_id, 'copy_id' => $model->copy_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Lending model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $lending_id
     * @param integer $user_id
     * @param string $copy_id
     * @return mixed
     */
    public function actionDelete($lending_id, $user_id, $copy_id) {
        $this->findModel($lending_id, $user_id, $copy_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lending model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $lending_id
     * @param integer $user_id
     * @param string $copy_id
     * @return Lending the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($lending_id, $user_id, $copy_id) {
        if (($model = Lending::findOne(['lending_id' => $lending_id, 'user_id' => $user_id, 'copy_id' => $copy_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDetalle($id){
        
    }

}

