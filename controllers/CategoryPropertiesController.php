<?php

namespace app\controllers;

use app\models\RefCategories;
use app\models\RefCategoryProperties;
use app\models\RefCategoryPropertiesSearch;
use app\models\RefCategoryRelProperty;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryPropertiesController implements the CRUD actions for RefCategoryProperties model.
 */
class CategoryPropertiesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all RefCategoryProperties models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RefCategoryPropertiesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefCategoryProperties model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RefCategoryProperties model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RefCategoryProperties();
        $request = Yii::$app->request->post();
        if ($this->request->isPost) {
            $response = $model::setModelSave($request['RefCategoryProperties']);
            if ($response['success']) {
                Yii::$app->session->setFlash('success', 'Ma\'lumot saqlandi!');
                return $this->redirect(['index']);
            } else{
                return $response['errors'];
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RefCategoryProperties model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $request = Yii::$app->request->post();

        if ($this->request->isPost) {
            $response = $model::setModelSave($request['RefCategoryProperties'], $id);
            if ($response['success']) {
                Yii::$app->session->setFlash('info', 'Ma\'lumot o\'zgartirildi!');
                return $this->redirect(['index']);
            } else{
                return $response['errors'];
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RefCategoryProperties model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('error', 'Ma\'lumot o\'chirildi');

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefCategoryProperties model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return RefCategoryProperties the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefCategoryProperties::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
