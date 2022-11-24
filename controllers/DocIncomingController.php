<?php

namespace app\controllers;

use app\models\WmsDocuments;
use app\models\WmsDocumentsSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocIncomingController implements the CRUD actions for WmsDocuments model.
 */
class DocIncomingController extends Controller
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
     * Lists all WmsDocuments models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new WmsDocumentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, WmsDocuments::DOC_TYPE_IN);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WmsDocuments model.
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
     * Creates a new WmsDocuments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new WmsDocuments();
        $model->doc_date = date('d.m.Y');

        if ($this->request->isPost) {
            $response =  $model::setDocSave([
                'doc' => $this->request->post(),
                'doc_type' => WmsDocuments::DOC_TYPE_IN,
            ]);
            if ($response['success']) {
                Yii::$app->session->setFlash('success', $response['message']);
                return $this->redirect(['view', 'id' => $response['id']]);
            } else{
                Yii::$app->session->setFlash('error', $response['message']);
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSaveFinish($id){
        if ($this->request->isGet) {
            $response = WmsDocuments::setDocSaveFinish($id);
            if ($response['success']) {
                Yii::$app->session->setFlash('success', 'Hujjat muaffaqiyatli tugatildi');
                return $this->redirect(['view', 'id' => $id]);
            } else{
                Yii::$app->session->setFlash('error', $response['message']);
                return $this->redirect(['view', 'id' => $id]);
            }
        }
    }
    public function actionDocReport(){
        return $this->render('doc-report');
    }

    public function actionReport(){
        try{
            if (Yii::$app->request->isGet){
                $request = Yii::$app->request->getBodyParams();
                if (!empty($request)){
                    return WmsDocuments::getDocReport([
                        'docType' => $request['docType'],
                        'products' => $request['products'],
                        'clients' => $request['clients'],
                        'fromDate' => $request['fromDate'],
                        'toDate' => $request['toDate'],
                    ]);
                }else{
                    $response['message'] = 'Not set data or docItems not data';
                    return $response;
                }
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Updates an existing WmsDocuments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->doc_date = date('d.m.Y',$model->doc_date);
        $model->docItems = $model->wmsDocumentItems;

        if ($this->request->isPost) {
            $response =  $model::setDocSave([
                'docID' => $model->id,
                'doc_number' => $model->doc_number,
                'doc' => $this->request->post(),
                'doc_type' => WmsDocuments::DOC_TYPE_IN,
            ]);
            if ($response['success']) {
                Yii::$app->session->setFlash('success', $response['message']);
                return $this->redirect(['view', 'id' => $response['id']]);
            } else{
                Yii::$app->session->setFlash('error', $response['message']);
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WmsDocuments model.
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
     * Finds the WmsDocuments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return WmsDocuments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WmsDocuments::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
