<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "hr_departments".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $parent_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $root
 * @property int|null $lft
 * @property int|null $rgt
 * @property int|null $lvl
 * @property string|null $icon
 * @property int|null $icon_type
 * @property bool|null $active
 * @property bool|null $selected
 * @property bool|null $disabled
 * @property bool|null $readonly
 * @property bool|null $visible
 * @property bool|null $collapsed
 * @property bool|null $movable_u
 * @property bool|null $movable_d
 * @property bool|null $movable_l
 * @property bool|null $movable_r
 * @property bool|null $removable
 * @property bool|null $removable_all
 * @property bool|null $child_allowed
 *
 * @property HrDepartmentRelEmployee[] $hrDepartmentRelEmployees
 * @property HrDepartments[] $hrDepartments
 * @property HrDepartments $parent
 * @property WmsDocuments[] $wmsDocuments
 * @property WmsItemBalanceStatus[] $wmsItemBalanceStatuses
 * @property WmsItemBalance[] $wmsItemBalances
 */
class HrDepartments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hr_departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'root', 'lft', 'rgt', 'lvl', 'icon_type'], 'default', 'value' => null],
            [['parent_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'root', 'lft', 'rgt', 'lvl', 'icon_type'], 'integer'],
            [['active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all', 'child_allowed'], 'boolean'],
            [['name', 'icon'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrDepartments::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'parent_id' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'root' => Yii::t('app', 'Root'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'lvl' => Yii::t('app', 'Lvl'),
            'icon' => Yii::t('app', 'Icon'),
            'icon_type' => Yii::t('app', 'Icon Type'),
            'active' => Yii::t('app', 'Active'),
            'selected' => Yii::t('app', 'Selected'),
            'disabled' => Yii::t('app', 'Disabled'),
            'readonly' => Yii::t('app', 'Readonly'),
            'visible' => Yii::t('app', 'Visible'),
            'collapsed' => Yii::t('app', 'Collapsed'),
            'movable_u' => Yii::t('app', 'Movable U'),
            'movable_d' => Yii::t('app', 'Movable D'),
            'movable_l' => Yii::t('app', 'Movable L'),
            'movable_r' => Yii::t('app', 'Movable R'),
            'removable' => Yii::t('app', 'Removable'),
            'removable_all' => Yii::t('app', 'Removable All'),
            'child_allowed' => Yii::t('app', 'Child Allowed'),
        ];
    }

    /**
     * Gets query for [[HrDepartmentRelEmployees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartmentRelEmployees()
    {
        return $this->hasMany(HrDepartmentRelEmployee::className(), ['hr_department_id' => 'id']);
    }

    /**
     * Gets query for [[HrDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartments()
    {
        return $this->hasMany(HrDepartments::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(HrDepartments::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[WmsDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsDocuments()
    {
        return $this->hasMany(WmsDocuments::className(), ['hr_department_id' => 'id']);
    }

    /**
     * Gets query for [[WmsItemBalanceStatuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsItemBalanceStatuses()
    {
        return $this->hasMany(WmsItemBalanceStatus::className(), ['hr_department_id' => 'id']);
    }

    /**
     * Gets query for [[WmsItemBalances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWmsItemBalances()
    {
        return $this->hasMany(WmsItemBalance::className(), ['hr_department_id' => 'id']);
    }

    public static function getDepartment($id = null){
        if ($id !== null){
            $model = self::findOne($id);
        }
        else{
            $model = ArrayHelper::map(self::find()->all(), 'id', 'name');
        }
        return $model;
    }
}
