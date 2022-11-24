<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_department_rel_employee}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%hr_departments}}`
 * - `{{%hr_employees}}`
 */
class m220421_092646_add_auth_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%auth_item}}', 'name_for_user', $this->string()->after('name'));
        $this->addColumn('{{%auth_item}}', 'category', $this->string()->after('name_for_user'));
        $this->addColumn('{{%auth_item}}', 'role_type', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%auth_item}}', 'category');
        $this->dropColumn('{{%auth_item}}', 'name_for_user');
        $this->dropColumn('{{%auth_item}}', 'role_type');
    }
}
