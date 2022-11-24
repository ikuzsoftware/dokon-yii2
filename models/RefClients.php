<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_clients".
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property WmsDocuments[] $wmsDocuments
 */
class RefClients extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_clients';
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
            [['name', 'address', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Mijoz'),
            'address' => Yii::t('app', 'Manzili'),
            'phone' => Yii::t('app', 'Telefon'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[WmsDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsDocuments()
    {
        return $this->hasMany(WmsDocuments::className(), ['ref_client_id' => 'id']);
    }

    public static function getClient($id = null){
        if ($id !== null){
            $model = self::findOne($id);
        }
        else{
            $model = ArrayHelper::map(self::find()->all(), 'id', 'name');
        }
        return $model;
    }
}
