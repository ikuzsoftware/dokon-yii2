<?php

namespace app\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\db\Exception;

/**
 * This is the model class for table "wms_documents".
 *
 * @property int $id
 * @property int|null $doc_type
 * @property int|null $hr_department_id
 * @property int|null $from_hr_department_id
 * @property int|null $to_hr_department_id
 * @property int|null $ref_client_id
 * @property int|null $from_ref_client_id
 * @property int|null $to_ref_client_id
 * @property string|null $doc_number
 * @property int|null $doc_date
 * @property string|null $description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $parent_wms_doc_id
 *
 * @property HrDepartments $hrDepartment
 * @property RefClients $refClient
 * @property WmsDocumentItems[] $wmsDocumentItems
 */
class WmsDocuments extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    const DOC_TYPE_IN = 1;
    const DOC_TYPE_OUT = 2;
    const DOC_TYPE_MOVING_IN = 3;
    const DOC_TYPE_MOVING_OUT = 4;
    const DOC_TYPE_ACCEPT = 5;


    public $docItems;
    public static function tableName()
    {
        return 'wms_documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_type', 'hr_department_id', 'from_hr_department_id', 'to_hr_department_id', 'ref_client_id', 'from_ref_client_id', 'to_ref_client_id', 'doc_date', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'parent_wms_doc_id'], 'default', 'value' => null],
            [['doc_type', 'hr_department_id', 'from_hr_department_id', 'to_hr_department_id', 'ref_client_id', 'from_ref_client_id', 'to_ref_client_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'parent_wms_doc_id'], 'integer'],
            [['doc_number'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 255],
            [['docItems', 'doc_date'], 'safe'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['hr_department_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrDepartments::className(), 'targetAttribute' => ['hr_department_id' => 'id']],
            [['ref_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefClients::className(), 'targetAttribute' => ['ref_client_id' => 'id']],
//            [['from_ref_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefClients::className(), 'targetAttribute' => ['from_ref_client_id' => 'id']],
            [['from_hr_department_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrDepartments::className(), 'targetAttribute' => ['from_hr_department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'doc_type' => Yii::t('app', 'Doc Type'),
            'hr_department_id' => Yii::t('app', 'Hr Department ID'),
            'from_hr_department_id' => Yii::t('app', 'From Hr Department ID'),
            'to_hr_department_id' => Yii::t('app', 'To Hr Department ID'),
            'ref_client_id' => Yii::t('app', 'Ref Client ID'),
            'from_ref_client_id' => Yii::t('app', 'From Ref Client ID'),
            'to_ref_client_id' => Yii::t('app', 'To Ref Client ID'),
            'doc_number' => Yii::t('app', 'Doc Number'),
            'doc_date' => Yii::t('app', 'Hujjat sanasi'),
            'description' => Yii::t('app', 'Izoh'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'parent_wms_doc_id' => Yii::t('app', 'Parent Wms Doc ID'),
        ];
    }
//
//    public function beforeSave($insert)
//    {
//        $this->doc_date=$this->doc_date?date('Y-m-d hh:mm:ss',strtotime($this->doc_date)):date('Y-m-d hh:mm:ss');
//        return parent::beforeSave($insert);
//    }
//    public function afterfind()
//    {
//        $this->doc_date=$this->doc_date?date('d.m.Y hh:mm:ss',strtotime($this->doc_date)):date('d.m.Y hh:mm:ss');
//        parent::afterFind();
//    }


    /**
     * Gets query for [[HrDepartment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartment()
    {
        return $this->hasOne(HrDepartments::className(), ['id' => 'hr_department_id']);
    }
    public function getFromHrDepartment()
    {
        return $this->hasOne(HrDepartments::className(), ['id' => 'from_hr_department_id']);
    }

    /**
     * Gets query for [[RefClient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefClient()
    {
        return $this->hasOne(RefClients::className(), ['id' => 'ref_client_id']);
    }
    /**
     * Gets query for [[RefClient]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getFromRefClient()
//    {
//        return $this->hasOne(RefClients::className(), ['id' => 'from_ref_client_id']);
//    }

    /**
     * Gets query for [[WmsDocumentItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsDocumentItems()
    {
        return $this->hasMany(WmsDocumentItems::className(), ['wms_document_id' => 'id']);
    }
    
    public static function setDocSave($data = ['docID'=> null]){
        $response = [];
        $response['success'] = true;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $doc = $data['doc']['WmsDocuments']; // document
            $docType = $data['doc_type']; // document types exc: inc, out, trans
            if (isset($data['docID'])){
                $model = self::findOne($data['docID']);
            } else{
                $model = new self();
                $model->setAttribute('doc_number', self::getDocNumber($docType));
            }
            if ($model->load($doc, '')) {
                $model->setAttributes([
                    'doc_date' => strtotime($model->doc_date),
                    'doc_type' => $docType
                ]);
                if ($docType == self::DOC_TYPE_IN) {
                    $model->setAttributes([
                        'ref_client_id' => $model->from_ref_client_id,
                        'hr_department_id' => $model->to_hr_department_id,
                    ]);
                } elseif ($docType == self::DOC_TYPE_OUT) {
                    $model->setAttributes([
                        'hr_department_id' => $model->from_hr_department_id,
                        'ref_client_id' => $model->to_ref_client_id,
                    ]);
                } elseif ($docType == self::DOC_TYPE_MOVING_IN) {
                    $model->setAttributes([
                        'hr_department_id' => $model->to_hr_department_id,
                    ]);
                } else {
                    $response['success'] = false;
                    $response['error'] = 'Invalid document type';
                }

                if ($model->save() AND $response['success']) {
                    $response = self::setModelSave($model, $model['docItems'], $response);

                    if ($docType == self::DOC_TYPE_MOVING_IN) {
                        $modelAcceptDoc = new self();
                        $modelAcceptDoc->setAttributes([
                            'doc_type' => self::DOC_TYPE_ACCEPT,
                            'doc_number' => 'QABUL-0101/2022',
                            'from_hr_department_id' => $model->from_hr_department_id,
                            'to_hr_department_id' => $model->to_hr_department_id,
                            'hr_department_id' => $model->from_hr_department_id,
                            'parent_wms_doc_id' => $model->id,
                        ]);
                        $modelAcceptDoc->save();
                        self::setModelSave($modelAcceptDoc, $model['docItems'], $response);
                    }
                    if ($response['success']) {
                        $response['message'] = 'Document saved successfully';
                        $response['id'] = $model->id;
                        $transaction->commit();
                    } else {
                        $response['error'] = 'Document saved but some items could not be saved';
                        $transaction->rollBack();
                    }
                } else {
                    $response = ['status' => 400, 'success' => false, 'message' => 'Document saved failed to WmsDocuments', 'data' => $model->errors];
                }
            }

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $response;
        
    }

    public static function setModelSave($model, $data, $response){
        $modelID = $model->id;
        WmsDocumentItems::deleteAll(['wms_document_id' => $modelID]);
        foreach ($data as $item) {
            $modelItem = new WmsDocumentItems();

            $modelItem->setAttributes([
                'wms_document_id' => $modelID,
                'ref_product_id' => $item['ref_product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'currency_type_id' => $item['currency_type_id'],
                'unit_type_id' => $item['unit_type_id'],
            ]);
            if ($modelItem->save()) {
                $response['success'] = true;
                $response['data']['doc'] = $model;
                $response['data']['docItem'][] = $modelItem;
            } else {
                $response['success'] = false;
                $response['error'] = $modelItem->errors;
                break;
            }
        }
        $modelItem = WmsDocumentItems::find()->where(['wms_document_id' => $modelID])->all();
        if (empty($modelItem)){
            $model->delete();
        }
        return $response;
    }

    public static function setDocSaveFinish($id)
    {
        $response = [];
        $response['success'] = true;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = self::findOne([
                'id' => $id,
                'status' => self::STATUS_ACTIVE
            ]);
            if (!empty($model)){
                $model->setAttribute('status', self::STATUS_SAVED);
                $model->save();
                $modelItem = WmsDocumentItems::getWmsDocItemListOne($model->id);
                if ($model->doc_type == self::DOC_TYPE_IN OR $model->doc_type == self::DOC_TYPE_ACCEPT) {
                    foreach ($modelItem as $item) {
                        
                        $balance = WmsItemBalance::getTestBalance([
                            'hrDepartment' => $model->hr_department_id,
                            'refProduct' => $item['ref_product_id']
                        ]);
//                        $balance = WmsItemBalance::find()
//                            ->where([
//                                'hr_department_id' => $model->hr_department_id,
//                                'ref_product_id' => $item['ref_product_id']
//                            ])
//                            ->orderBy('id DESC')
//                            ->asArray()
//                            ->one();
                        $modelItemBalance = new WmsItemBalance();
                        $modelItemBalance->setAttributes([
                            'hr_department_id' => $model->hr_department_id,
                            'ref_product_id' => $item['ref_product_id'],
                            'quantity' => $item['quantity'],
                            'inventory_balance' => !empty($balance['inventory_balance']) ? ($balance['inventory_balance'] + $item['quantity']) : $item['quantity'],
                            'inventory_date' => time(),
                        ]);
                        if ($modelItemBalance->save()) {
                            $response['success'] = true;
                            $response['status'] = 200;
                            $response['message'] = 'Document saved successfully';
                        } else {
                            $response = ['status' => 400, 'success' => false, 'message' => 'Document saved failed to WmsDocumentItems', 'data' => $modelItemBalance->errors];
                            break;
                        }

                    }
                }elseif ($model->doc_type == self::DOC_TYPE_OUT OR $model->doc_type == self::DOC_TYPE_MOVING_IN){
                    foreach ($modelItem as $item) {
                        $balance = WmsItemBalance::getTestBalance([
                            'hrDepartment' => $model->hr_department_id,
                            'refProduct' => $item['ref_product_id']
                        ]);

                        $modelItemBalance = new WmsItemBalance();
                        $modelItemBalance->setAttributes([
                            'hr_department_id' => $model->hr_department_id,
                            'ref_product_id' => $item['ref_product_id'],
                            'quantity' => -1 * $item['quantity'],
                            'inventory_date' => time(),
                        ]);
                        if (!empty($balance['inventory_balance'])){
                            if ($balance['inventory_balance'] > $item['quantity']){
                                $modelItemBalance->setAttribute('inventory_balance', $balance['inventory_balance'] - $item['quantity']);
                            } else{
                                $response = ['status' => 400, 'success' => false, 'message' => 'Document saved failed to WmsItemBalance Maxsulot yetarli emas!', 'data' => $modelItemBalance->errors];
                                break;
                            }
                        } else {
                            $response = ['status' => 400, 'success' => false, 'message' => 'Document saved failed to WmsItemBalance Maxsulot mavjud emas!', 'data' => ['Product' => $item['ref_product_id']]];
                            break;
                        }

                        if ($modelItemBalance->save()) {
                            $response['success'] = true;
                            $response['status'] = 200;
                            $response['message'] = 'Document saved successfully';
                        } else {
                            $response = ['status' => 400, 'success' => false, 'message' => 'Document saved failed to WmsDocumentItems', 'data' => $modelItemBalance->errors];
                            break;
                        }
                    }
                }else{
                    $response = ['status' => 400, 'success' => false, 'message' => 'Document type not found'];
                }
                if ($response['success']) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } else {
                $response = ['status' => 400, 'success' => false, 'message' => 'Document not found'];
            }

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $response;
    }

    public static function getDocReport($data = ['docType' => null, 'products' => null, 'clients' => null, 'fromDate' => null, 'toDate' => null]): array
    {
        $response = ['status' => '', 'success' => true, 'message' => '', 'data' => []];
        try {
            $toDate = !empty($data['toDate']) ? strtotime($data['toDate']) : strtotime(date('Y-m-d'));
            $fromDate = !empty($data['fromDate']) ? strtotime($data['fromDate']) : strtotime(date('Y-m-d'));

            $query = self::find()->alias('wd')
                ->select([
                    'wd.doc_type',
                    'rp.name as Maxsulot',
                    'rc.name as Mijoz',
                    "to_char(to_timestamp(wd.doc_date::numeric), 'dd.mm.YYYY') AS Sana",
                    'wdi.quantity as Soni',
                    'wdi.price as Narxi',
                    "(wdi.quantity*wdi.price) AS Summasi",
                ])
                ->where([
                    'wd.doc_type' => $data['docType'],
                    'wd.status' => self::STATUS_SAVED,
                ])
                ->leftJoin(['wdi' => 'wms_document_items'], 'wdi.wms_document_id = wd.id')
                ->andFilterWhere(['ref_client_id' => $data['clients']])
                ->andFilterWhere(['wdi.ref_product_id' => $data['products']])
                ->andFilterWhere(['between', 'wd.created_at', $fromDate, $toDate])
                ->leftJoin(['rp' => 'ref_products'], 'rp.id = wdi.ref_product_id')
                ->leftJoin(['rc' => 'ref_clients'], 'rc.id = wd.ref_client_id')
                ->orderBy('wd.created_at DESC')
                ->asArray()
                ->all();
            $provider = new ArrayDataProvider([
                'allModels' => $query,
                'pagination' => [
                    'pageSize' => 4,
                ],
                'sort' => [
                    'attributes' => ['id', 'name'],
                ],
            ]);
            if (!empty($provider)) {
                $response = ['status' => 200, 'success' => true, 'message' => 'Document search successfully', 'data' => $provider];
            } else {
                $response['message'] = "No data found";
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $response;
    }

    // generate document incoming number

    public static function getDocNumber($type)
    {
        $docNumber = '';
        if ($type == self::DOC_TYPE_IN){
            $docNumber = 'IN-' . date('ymd') . str_pad(date('his'), 4, '0', STR_PAD_LEFT);
        } elseif ($type == self::DOC_TYPE_OUT){
            $docNumber = 'OUT-' . date('ymd') . str_pad(date('his'), 4, '0', STR_PAD_LEFT);
        } elseif ($type == self::DOC_TYPE_MOVING_IN){
            $docNumber = 'MOV-' . date('ymd') . str_pad(date('his'), 4, '0', STR_PAD_LEFT);
        }
        return $docNumber;
    }
}
