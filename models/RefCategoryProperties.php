<?php

namespace app\models;

use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_category_properties".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $category_id
 *
 * @property RefCategoryRelProperty[] $refCategoryRelProperties
 */
class RefCategoryProperties extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_category_properties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'category_id'], 'integer'],
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
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'category_id' => Yii::t('app', 'Bo\'lim'),
        ];
    }

    /**
     * Gets query for [[RefCategoryRelProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefCategoryRelProperties()
    {
        return $this->hasMany(RefCategoryRelProperty::className(), ['ref_property_id' => 'id']);
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
                foreach ($data['name'] as $value){
                    if (empty($value)){
                        continue;
                    }
                    $model->setAttributes([
                        'category_id' => $data['category_id'],
                        'name' => $value
                    ]);
                    if (!$model->save()){
                        $saved = false;
                        $response['errors'] = $model->errors;
                        break;
                    } else{
                        $model = new self();
                    }
                }
                if ($saved) {
                    $response['success'] = true;
                    $transaction->commit();
                } else {
                    $response['success'] = false;
                    $transaction->rollBack();
                }
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $response;
    }

    public static function getPropertyList($category_id = null)
    {
        return ArrayHelper::map(self::find()->where(['category_id' => $category_id])->all(), 'id', 'name');
    }
}
