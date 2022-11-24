<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_category_rel_property".
 *
 * @property int $id
 * @property int|null $ref_category_id
 * @property int|null $ref_property_id
 * @property string|null $value
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property RefCategories $refCategory
 * @property RefCategoryProperties $refProperty
 */
class RefCategoryRelProperty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_category_rel_property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref_category_id', 'ref_property_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['ref_category_id', 'ref_property_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['ref_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefCategories::className(), 'targetAttribute' => ['ref_category_id' => 'id']],
            [['ref_property_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefCategoryProperties::className(), 'targetAttribute' => ['ref_property_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ref_category_id' => Yii::t('app', 'Ref Category ID'),
            'ref_property_id' => Yii::t('app', 'Ref Property ID'),
            'value' => Yii::t('app', 'Value'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
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
     * Gets query for [[RefProperty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefProperty()
    {
        return $this->hasOne(RefCategoryProperties::className(), ['id' => 'ref_property_id']);
    }
}
