<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_attachments".
 *
 * @property int $id
 * @property string|null $path
 * @property int|null $size
 * @property string|null $name
 * @property string|null $type
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property RefProductRelAttachment[] $refProductRelAttachments
 */
class RefAttachments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_attachments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['size', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['path', 'name', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'path' => Yii::t('app', 'Path'),
            'size' => Yii::t('app', 'Size'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[RefProductRelAttachments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefProductRelAttachments()
    {
        return $this->hasMany(RefProductRelAttachment::className(), ['ref_attachment_id' => 'id']);
    }
}
