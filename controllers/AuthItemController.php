<?php

namespace app\controllers;

use app\models\AuthItem;
use app\models\AuthItemChild;
use app\models\AuthItemSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends SiteController
{
    /**
     * @inheritDoc
     */

//    public function beforeAction($action)
//    {
//        $can = \Yii::$app->user->can(\Yii::$app->controller->id. "/" . \Yii::$app->controller->action->id);
//        if (!$can){
//            throw new ForbiddenHttpException('Access denied');
//        }
//        return parent::beforeAction($action);
//    }

    /**
     * Lists all AuthItem models.
     *
     * @return string
     */
    public function actionRule()
    {
        $searchModel = new AuthItemSearch();
        $searchModel->is_type = AuthItem::AUTH_ITEM_RULE;
        $dataProvider = $searchModel->search($this->request->queryParams, AuthItem::AUTH_ITEM_RULE);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /***
     *
     * @return string
     */
    public function actionPermission()
    {
        $searchModel = new AuthItemSearch();
        $searchModel->is_type = AuthItem::AUTH_ITEM_PERMISSION;
        $dataProvider = $searchModel->search($this->request->queryParams, AuthItem::AUTH_ITEM_PERMISSION);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $searchModel->is_type = \Yii::$app->request->get('is_type', AuthItem::AUTH_ITEM_RULE);
        $dataProvider = $searchModel->search($this->request->queryParams, $searchModel->is_type);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $name Name
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($name, $type)
    {
        return $this->render('view', [
            'model' => $this->findModel($name, $type),
            'type' => $type,
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AuthItem();
        $model->type = \Yii::$app->request->get('type');
        if ($model->type == AuthItem::AUTH_ITEM_PERMISSION){
            $model->new_permissions = [
                ['name' => 'index', 'description' => 'index'],
                ['name' => 'create', 'description' => 'create'],
                ['name' => 'update', 'description' => 'update'],
                ['name' => 'view', 'description' => 'view'],
                ['name' => 'delete', 'description' => 'delete'],
            ];
        }
        if ($this->request->isPost) {
            if($model->type == AuthItem::AUTH_ITEM_RULE){
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'name' => $model->name, 'type' => $model->type]);
                }
            }

            if($model->type == AuthItem::AUTH_ITEM_PERMISSION && $model->load($this->request->post())){
                $transaction = \Yii::$app->db->beginTransaction();
                $flag = false;
                try {
                    if (!empty($model->new_permissions)){
                        foreach ($model->new_permissions as $new_permission) {
                            if (AuthItem::findOne(['name' => $model->controller.'/'.$new_permission['name']]) == null){
                                $permission = new AuthItem([
                                    'name' => $model->name.'/'.$new_permission['name'],
                                    'description' => $new_permission['description'],
                                    'type' => AuthItem::AUTH_ITEM_PERMISSION
                                ]);
                                if ($permission->save() == false){
                                    $flag == false;
                                    break;
                                }
                            }

                            $rule_rel = new AuthItemChild([
                                'parent' => $model->category,
                                'child' => $model->name.'/'.$new_permission['name'],
                            ]);
                            if($rule_rel->save()){
                                $flag = true;
                            }
                            else{
                                $flag = false;
                                break;
                            }
                        }
                        if($flag){
                            $transaction->commit();
                            return $this->redirect(['permission']);
                        }
                        else{
                            $transaction->rollBack();
                            debug($rule_rel->getErrors());
                            debug($permission->getErrors()); die();
                        }
                    }
                }
                catch (\Exception $exception) {
                    debug($exception); die();
                }
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $name Name
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($name, $type)
    {
        $model = $this->findModel($name, $type);
        if ($model->type == AuthItem::AUTH_ITEM_PERMISSION){
            $control_action = explode('/', $name);
            $model->name = $control_action[0];
            $cate = AuthItemChild::findOne(['child' => $name]);
            $model->category = $cate->parent;
            $model->new_permissions = [
                [
                    'name' => $control_action['1'],
                    'description' => $model->description,
                ]
            ];

        }

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->name = $model->name . "/" . $model->new_permissions[0]['name'];
            $model->description = $model->new_permissions[0]['description'];
            $cate = AuthItemChild::findOne(['child' => $name]);
            $cate->parent = $model->category;
            $cate->save();
            if ($model->save()) {
                return $this->redirect(['view', 'name' => $model->name, 'type' => $model->type]);
            } else {
                debug($model->getErrors()); die();
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $name Name
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($name, $type)
    {
        if ($type == AuthItem::AUTH_ITEM_RULE){
            // Rule delete qilinganda birgalkikda shu rulga bog'liq permissionlar olib tashlanadi
            $auth_item_child = AuthItemChild::find()->where(['parent' => $name])->asArray()->all();
            $this->findModel($name, $type)->delete();

            foreach ($auth_item_child as $item){
                $this->findModel($item['child'], AuthItem::AUTH_ITEM_PERMISSION)->delete();
            }
            return $this->redirect(['rule']);
        }
        if ($type == AuthItem::AUTH_ITEM_PERMISSION){
            $this->findModel($name, $type)->delete();
            return $this->redirect(['permission']);
        }

    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name Name
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name, $type)
    {
        if (($model = AuthItem::findOne(['name' => $name, 'type' => $type])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
