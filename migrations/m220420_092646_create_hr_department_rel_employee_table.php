<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_department_rel_employee}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%hr_departments}}`
 * - `{{%hr_employees}}`
 */
class m220420_092646_create_hr_department_rel_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_department_rel_employee}}', [
            'id' => $this->primaryKey(),
            'hr_employee_id' => $this->integer(),
            'hr_department_id' => $this->integer(),

            'type' => $this->smallInteger()->defaultValue(1),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `hr_department`
        $this->createIndex(
            '{{%idx-hr_department_rel_employee-hr_department_id}}',
            '{{%hr_department_rel_employee}}',
            'hr_department_id'
        );

        // add foreign key for table `{{%hr_departments}}`
        $this->addForeignKey(
            '{{%fk-hr_department_rel_employee-hr_department_id}}',
            '{{%hr_department_rel_employee}}',
            'hr_department_id',
            '{{%hr_departments}}',
            'id',
            'RESTRICT'
        );

        // creates index for column `hr_employee_id`
        $this->createIndex(
            '{{%idx-hr_department_rel_employee-hr_employee_id}}',
            '{{%hr_department_rel_employee}}',
            'hr_employee_id'
        );

        // add foreign key for table `{{%hr_employees}}`
        $this->addForeignKey(
            '{{%fk-hr_department_rel_employee-hr_employee_id}}',
            '{{%hr_department_rel_employee}}',
            'hr_employee_id',
            '{{%hr_employees}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%hr_departments}}`
        $this->dropForeignKey(
            '{{%fk-hr_department_rel_employee-hr_department_id}}',
            '{{%hr_department_rel_employee}}'
        );

        // drops index for column `hr_department`
        $this->dropIndex(
            '{{%idx-hr_department_rel_employee-hr_department_id}}',
            '{{%hr_department_rel_employee}}'
        );

        // drops foreign key for table `{{%hr_employees}}`
        $this->dropForeignKey(
            '{{%fk-hr_department_rel_employee-hr_employee_id}}',
            '{{%hr_department_rel_employee}}'
        );

        // drops index for column `hr_employee_id`
        $this->dropIndex(
            '{{%idx-hr_department_rel_employee-hr_employee_id}}',
            '{{%hr_department_rel_employee}}'
        );

        $this->dropTable('{{%hr_department_rel_employee}}');
    }
}
