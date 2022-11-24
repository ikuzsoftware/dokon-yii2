<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_product_barcodes".
 *
 * @property int $id
 * @property string|null $barcode
 * @property int|null $costumer_barcode_id
 * @property int|null $product_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property RefProducts $product
 */
class RefProductBarcodes extends \yii\db\ActiveRecord
{

    const CLIENT_BARCODE = 1;
    const SERVER_BARCODE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_product_barcodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['costumer_barcode_id', 'product_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['costumer_barcode_id', 'product_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['barcode'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefProducts::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'barcode' => Yii::t('app', 'Barcode'),
            'costumer_barcode_id' => Yii::t('app', 'Costumer Barcode ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(RefProducts::className(), ['id' => 'product_id']);
    }

    // barcode random generator
    public static function generateBarcode()
    {
        $barcode = rand(100000000, 999999999);
        $barcode = str_pad($barcode, 9, '0', STR_PAD_LEFT);
        return $barcode;
    }

}
