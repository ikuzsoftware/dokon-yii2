<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_departments}}`.
 */
class m220419_013432_create_hr_departments_fields_table extends Migration
{
    const TABLE_NAME = '{{%hr_departments}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn(self::TABLE_NAME, 'root', $this->integer());
        $this->addColumn(self::TABLE_NAME, 'lft', $this->integer()); // TODO notNull larni o'zgartiramiz ish tugaganda
        $this->addColumn(self::TABLE_NAME, 'rgt', $this->integer());
        $this->addColumn(self::TABLE_NAME, 'lvl', $this->smallInteger(5));
        $this->addColumn(self::TABLE_NAME, 'icon', $this->string(255));
        $this->addColumn(self::TABLE_NAME, 'icon_type', $this->smallInteger(1)->defaultValue(1));
        $this->addColumn(self::TABLE_NAME, 'active', $this->boolean()->defaultValue(true));
        $this->addColumn(self::TABLE_NAME, 'selected', $this->boolean()->defaultValue(false));
        $this->addColumn(self::TABLE_NAME, 'disabled', $this->boolean()->defaultValue(false));
        $this->addColumn(self::TABLE_NAME, 'readonly', $this->boolean()->defaultValue(false));
        $this->addColumn(self::TABLE_NAME, 'visible', $this->boolean()->defaultValue(true));
        $this->addColumn(self::TABLE_NAME, 'collapsed', $this->boolean()->defaultValue(false));
        $this->addColumn(self::TABLE_NAME, 'movable_u', $this->boolean()->defaultValue(true));
        $this->addColumn(self::TABLE_NAME, 'movable_d', $this->boolean()->defaultValue(true));
        $this->addColumn(self::TABLE_NAME, 'movable_l', $this->boolean()->defaultValue(true));
        $this->addColumn(self::TABLE_NAME, 'movable_r', $this->boolean()->defaultValue(true));
        $this->addColumn(self::TABLE_NAME, 'removable', $this->boolean()->defaultValue(true));
        $this->addColumn(self::TABLE_NAME, 'removable_all', $this->boolean()->defaultValue(false));
        $this->addColumn(self::TABLE_NAME, 'child_allowed', $this->boolean()->defaultValue(true));

        $this->createIndex('tree_NK1', 'hr_departments', 'root');
        $this->createIndex('tree_NK2', 'hr_departments', 'lft');
        $this->createIndex('tree_NK3', 'hr_departments', 'rgt');
        $this->createIndex('tree_NK4', 'hr_departments', 'lvl');
        $this->createIndex('tree_NK5', 'hr_departments', 'active');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       return true;
    }
}
