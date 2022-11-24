<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hr_positions".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property HrDepartmentRelEmployee[] $hrDepartmentRelEmployees
 */
class HrPositions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hr_positions';
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
     * Gets query for [[HrDepartmentRelEmployees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartmentRelEmployees()
    {
        return $this->hasMany(HrDepartmentRelEmployee::className(), ['hr_position_id' => 'id']);
    }
}
