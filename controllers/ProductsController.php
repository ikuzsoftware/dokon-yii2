<?php

namespace app\controllers;

use app\models\RefCategoryRelProperty;
use app\models\RefProductBarcodes;
use app\models\RefProducts;
use app\models\RefProductsSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductsController implements the CRUD actions for RefProducts model.
 */
class ProductsController extends Controller
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
     * Lists all RefProducts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RefProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefProducts model.
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
     * Creates a new RefProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RefProducts();

        $model_property = new RefCategoryRelProperty();

        $request = Yii::$app->request->post();

        if ($this->request->isPost) {
            $response = $model::setModelSave($request['RefProducts']);
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
            'model_property' => $model_property,
        ]);
    }

    /**
     * Updates an existing RefProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $barcode = RefProductBarcodes::findOne(['product_id' => $model->id]);
        $model->barcode = $barcode->barcode;

        $request = Yii::$app->request->post();

        if ($this->request->isPost) {
            $response = $model::setModelSave($request['RefProducts']);
            if ($response['success']) {
                Yii::$app->session->setFlash('success', 'Ma\'lumot saqlandi!');
                return $this->redirect(['index']);
            } else{
                return $response['errors'];
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RefProducts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return RefProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefProducts::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
