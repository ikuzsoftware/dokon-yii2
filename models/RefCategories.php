<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_categories".
 *
 * @property int $id
 * @property string $name
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property RefCategoryRelProperty[] $refCategoryRelProperties
 * @property RefProducts[] $refProducts
 */
class RefCategories extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Mahsulot bo\'limi'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[RefCategoryRelProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefCategoryRelProperties()
    {
        return $this->hasMany(RefCategoryRelProperty::className(), ['ref_category_id' => 'id']);
    }

    /**
     * Gets query for [[RefProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefProducts()
    {
        return $this->hasMany(RefProducts::className(), ['ref_category_id' => 'id']);
    }

    public static function getListCategory($id = null){
        if ($id !== null){
            $data = self::findOne($id)['name'];
        } else{
            $data = ArrayHelper::map(self::find()->all(), 'id', 'name');
        }
        return $data;
    }
}
