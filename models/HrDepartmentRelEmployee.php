<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hr_department_rel_employee".
 *
 * @property int $id
 * @property int|null $hr_employee_id
 * @property int|null $hr_department_id
 * @property int|null $type
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $hr_position_id
 * @property string|null $start_date
 * @property string|null $end_date
 *
 * @property HrDepartments $hrDepartment
 * @property HrEmployees $hrEmployee
 * @property HrPositions $hrPosition
 */
class HrDepartmentRelEmployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hr_department_rel_employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hr_employee_id', 'hr_department_id', 'type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'hr_position_id'], 'default', 'value' => null],
            [['hr_employee_id', 'hr_department_id', 'type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'hr_position_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['hr_department_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrDepartments::className(), 'targetAttribute' => ['hr_department_id' => 'id']],
            [['hr_employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrEmployees::className(), 'targetAttribute' => ['hr_employee_id' => 'id']],
            [['hr_position_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrPositions::className(), 'targetAttribute' => ['hr_position_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hr_employee_id' => Yii::t('app', 'Hr Employee ID'),
            'hr_department_id' => Yii::t('app', 'Hr Department ID'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'hr_position_id' => Yii::t('app', 'Hr Position ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
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
     * Gets query for [[HrEmployee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployee()
    {
        return $this->hasOne(HrEmployees::className(), ['id' => 'hr_employee_id']);
    }

    /**
     * Gets query for [[HrPosition]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrPosition()
    {
        return $this->hasOne(HrPositions::className(), ['id' => 'hr_position_id']);
    }
}
