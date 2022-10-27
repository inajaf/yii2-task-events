<?php

namespace app\controllers;

use Yii;
use yii\filters\AjaxFilter;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use app\models\Task;
use app\models\search\TaskSearch;

class TaskController extends AppController
{
    public function init()
    {
        $this->modelClass = Task::class;
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'ajax' => [
                    'class' => AjaxFilter::class,
                    'only' => ['update-complete']
                ]
            ]
        );
    }

    public function actionCreate()
    {
        $model = new $this->modelClass;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', 'New task was added');
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate(int $id)
    {
        $model = new $this->modelClass;
        $task = $model::findOne(["id" => $id]);

        if ($this->request->isPost) {
            if ($task->load($this->request->post()) && $task->validate() && $task->save()) {
                Yii::$app->session->setFlash('success', 'Task updated');
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', ['model' => $task]);
    }

    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdateComplete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $taskID = $data['taskID'];
            $complete = $data['complete'];

            if ($taskID) {
                $model = $this->modelClass::findOne(['id' => (int)$taskID]);
                $model->complete = $complete === 'true' ? 1 : 0;
                $model->save();


                return ['success' => 'complete value changed'];
            }
        }

        throw new NotFoundHttpException;
    }

}