<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wms_document_items".
 *
 * @property int $id
 * @property int|null $wms_document_id
 * @property int|null $ref_product_id
 * @property int|null $quantity
 * @property int|null $price
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $currency_type_id
 * @property int|null $unit_type_id
 *
 * @property RefCurrencyType $currencyType
 * @property RefProducts $refProduct
 * @property RefUnitType $unitType
 * @property WmsDocuments $wmsDocument
 */
class WmsDocumentItems extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_CREATE = 'create';
    public static function tableName()
    {
        return 'wms_document_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wms_document_id', 'ref_product_id', 'quantity', 'price', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'currency_type_id', 'unit_type_id'], 'default', 'value' => null],
            [['wms_document_id', 'ref_product_id', 'quantity', 'price', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'currency_type_id', 'unit_type_id'], 'integer'],
            [['currency_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefCurrencyType::className(), 'targetAttribute' => ['currency_type_id' => 'id']],
            [['ref_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefProducts::className(), 'targetAttribute' => ['ref_product_id' => 'id']],
            [['unit_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefUnitType::className(), 'targetAttribute' => ['unit_type_id' => 'id']],
            [['wms_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => WmsDocuments::className(), 'targetAttribute' => ['wms_document_id' => 'id']],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['currency_type_id', 'ref_product_id', 'quantity', 'price', 'unit_type_id'], 'required', 'on' => self::SCENARIO_CREATE],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'wms_document_id' => Yii::t('app', 'Wms Document ID'),
            'ref_product_id' => Yii::t('app', 'Ref Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'currency_type_id' => Yii::t('app', 'Currency Type ID'),
            'unit_type_id' => Yii::t('app', 'Unit Type ID'),
        ];
    }

    /**
     * Gets query for [[CurrencyType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyType()
    {
        return $this->hasOne(RefCurrencyType::className(), ['id' => 'currency_type_id']);
    }

    /**
     * Gets query for [[RefProduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefProduct()
    {
        return $this->hasOne(RefProducts::className(), ['id' => 'ref_product_id']);
    }

    /**
     * Gets query for [[UnitType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnitType()
    {
        return $this->hasOne(RefUnitType::className(), ['id' => 'unit_type_id']);
    }

    /**
     * Gets query for [[WmsDocument]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsDocument()
    {
        return $this->hasOne(WmsDocuments::className(), ['id' => 'wms_document_id']);
    }

    public static function getWmsDocItemListOne($id)
    {
        return self::find()
            ->where([
                'wms_document_id' => $id,
                'status' => self::STATUS_ACTIVE
            ])
            ->asArray()
            ->all();
    }
}
