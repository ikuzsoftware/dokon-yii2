<?php

namespace app\models;

use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_products".
 *
 * @property int $id
 * @property string $name
 * @property int|null $ref_category_id
 * @property int|null $ref_product_model_id
 * @property string|null $barcode
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $type
 *
 * @property ProductBarcodes[] $productBarcodes
 * @property RefCategories $refCategory
 * @property RefProductModels $refProductModel
 * @property RefProductRelAttachment[] $refProductRelAttachments
 * @property WmsDocumentItems[] $wmsDocumentItems
 * @property WmsItemBalanceStatus[] $wmsItemBalanceStatuses
 * @property WmsItemBalance[] $wmsItemBalances
 */
class RefProducts extends BaseModel
{
    public $property;
    public $custom_barcode;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['ref_category_id', 'ref_product_model_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'type'], 'default', 'value' => null],
            [['ref_category_id', 'ref_product_model_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'type'], 'integer'],
            [['name', 'barcode'], 'string', 'max' => 255],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['property', 'custom_barcode'], 'safe'],
            [['ref_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefCategories::className(), 'targetAttribute' => ['ref_category_id' => 'id']],
            [['ref_product_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefProductModels::className(), 'targetAttribute' => ['ref_product_model_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'mahsulot nomi'),
            'ref_category_id' => Yii::t('app', 'Bo\'lim nomi'),
            'ref_product_model_id' => Yii::t('app', 'Product model'),
            'barcode' => Yii::t('app', 'Barcode'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * Gets query for [[ProductBarcodes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductBarcodes()
    {
        return $this->hasMany(RefProductBarcodes::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[RefCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefCategory()
    {
        return $this->hasOne(RefCategories::className(), ['id' => 'ref_category_id']);
    }

    /**
     * Gets query for [[RefProductModel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefProductModel()
    {
        return $this->hasOne(RefProductModels::className(), ['id' => 'ref_product_model_id']);
    }

    /**
     * Gets query for [[RefProductRelAttachments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefProductRelAttachments()
    {
        return $this->hasMany(RefProductRelAttachment::className(), ['ref_product_id' => 'id']);
    }

    /**
     * Gets query for [[WmsDocumentItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsDocumentItems()
    {
        return $this->hasMany(WmsDocumentItems::className(), ['ref_product_id' => 'id']);
    }

    /**
     * Gets query for [[WmsItemBalanceStatuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsItemBalanceStatuses()
    {
        return $this->hasMany(WmsItemBalanceStatus::className(), ['ref_product_id' => 'id']);
    }

    /**
     * Gets query for [[WmsItemBalances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsItemBalances()
    {
        return $this->hasMany(WmsItemBalance::className(), ['ref_product_id' => 'id']);
    }
    
    public static function setModelSave($data, $id = null){
        $response = [];
        $saved = true;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($id !== null){
                $model = self::findOne($id);
            }
            else{
                $model = new self();
            }
            if (!$model->load($data, '')){
                $saved = false;
                $response['errors'] = $model->errors;
            } else{
                $model->setAttribute('barcode', '');
                if (!$model->save()){
                    $saved = false;
                    $response['errors'] = $model->errors;
                } else{
                    $model_barcode = new RefProductBarcodes();
                    $model_barcode->setAttribute('product_id', $model->id);
                    
                    if (!empty($data['barcode'])){
                        $model_barcode->setAttributes([
                            'barcode' => $data['barcode'],
                            'costumer_barcode_id' => $model_barcode::CLIENT_BARCODE,
                        ]);
                    } else{
                        $model_barcode->setAttributes([
                            'barcode' => $model_barcode::generateBarcode(),
                            'costumer_barcode_id' => $model_barcode::SERVER_BARCODE,
                        ]);
                    }
                    if (!$model_barcode->save()){
                        $saved = false;
                        $response['errors'] = $model_barcode->errors;
                    } else{
                        if (!empty($data['property'])) {
                            foreach ($data['property'] as $value) {
                                $modelProperty = new RefProductRelProperty();
                                if (empty($value)) {
                                    continue;
                                }
                                $modelProperty->setAttributes([
                                    'ref_product_id' => $model->id,
                                    'ref_property_id' => $value['id'],
                                    'value' => $value['value'],
                                ]);
                                if (!$modelProperty->save()) {
                                    $saved = false;
                                    $response['errors'] = $modelProperty->errors;
                                    break;
                                }
                            }
                        }
                    }
                    if ($saved) {
                        $response['success'] = true;
                        $response['barcode'] = $model_barcode->barcode;
                        $transaction->commit();
                    } else {
                        $response['success'] = false;
                        $transaction->rollBack();
                    }
                }
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $response;
    }

    public static function getGenerateBarcode(){
        //Widht of the barcode image.
        $width  = 284;
//Height of the barcode image.
        $height = 184;
//Quality of the barcode image. Only for JPEG.
        $quality = 100;
//1 if text should appear below the barcode. Otherwise 0.
        $text =1;
// Location of barcode image storage.
        $location = Yii::getAlias("webroot").'/bc';

        Yii::import("application.extensions.barcode.*");
        barcode::Barcode39('some text', $width , $height , $quality, $text, $location);
    }

    public static function getProduct($id = null){
        if ($id !== null){
            $model = self::findOne($id);
        }
        else{
            $model = ArrayHelper::map(self::find()->all(), 'id', 'name');
        }
        return $model;
    }
}
