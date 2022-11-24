<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wms_item_balance".
 *
 * @property int $id
 * @property int|null $hr_department_id
 * @property int|null $ref_product_id
 * @property int|null $quantity
 * @property int|null $inventory_balance
 * @property int|null $inventory_date
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property HrDepartments $hrDepartment
 * @property RefProducts $refProduct
 */
class WmsItemBalance extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wms_item_balance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hr_department_id', 'ref_product_id', 'quantity', 'inventory_balance', 'inventory_date', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['hr_department_id', 'ref_product_id', 'quantity', 'inventory_balance', 'inventory_date', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['hr_department_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrDepartments::className(), 'targetAttribute' => ['hr_department_id' => 'id']],
            [['ref_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefProducts::className(), 'targetAttribute' => ['ref_product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hr_department_id' => Yii::t('app', 'Hr Department ID'),
            'ref_product_id' => Yii::t('app', 'Ref Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'inventory_balance' => Yii::t('app', 'Inventory Balance'),
            'inventory_date' => Yii::t('app', 'Inventory Date'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[HrDepartment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartment()
    {
        return $this->hasOne(HrDepartments::className(), ['id' => 'hr_department_id']);
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

    public static function getTestBalance($data = ['hrDepartment' => null, 'refProduct' => null]){
        return  self::find()
            ->where([
                'hr_department_id' => $data['hrDepartment'],
                'ref_product_id' => $data['refProduct'],
            ])
            ->orderBy('id DESC')
            ->asArray()
            ->one();
    }
}
