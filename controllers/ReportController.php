<?php
namespace app\controllers;
use app\models\WmsItemBalanceSearch;

class ReportController extends \yii\base\Controller{
    /**
     * @return string
     */
    public function actionRemain(){
        $searchModel = new WmsItemBalanceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('remain', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}