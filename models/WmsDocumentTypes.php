<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wms_document_types".
 *
 * @property int $id
 * @property int|null $type
 * @property string|null $name
 * @property string|null $prefix
 * @property string|null $token
 * @property string|null $description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class WmsDocumentTypes extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wms_document_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['name', 'prefix', 'token', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'prefix' => Yii::t('app', 'Prefix'),
            'token' => Yii::t('app', 'Token'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
