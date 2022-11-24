<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_unit_type".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property WmsDocumentItems[] $wmsDocumentItems
 */
class RefUnitType extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_unit_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[WmsDocumentItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsDocumentItems()
    {
        return $this->hasMany(WmsDocumentItems::className(), ['unit_type_id' => 'id']);
    }

    public  static function getUnitTypeList()
    {
        $list = self::find()->select(['id', 'name'])->where(['status' => self::STATUS_ACTIVE])->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
}
