                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%hr_department_rel_employee}}`.
 */
class m220424_080641_add_hr_position_id_column_to_hr_department_rel_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('hr_department_rel_employee', 'hr_position_id', $this->integer());
        $this->addColumn('hr_department_rel_employee', 'start_date', $this->date());
        $this->addColumn('hr_department_rel_employee', 'end_date', $this->date());

        $this->createIndex(
            '{{%idx-hr_department_rel_employee-hr_position_id}}',
            '{{%hr_department_rel_employee}}',
            'hr_position_id'
        );

        // add foreign key for table `{{%hr_positions}}`
        $this->addForeignKey(
            '{{%fk-hr_department_rel_employee-hr_position_id}}',
            '{{%hr_department_rel_employee}}',
            'hr_position_id',
            '{{%hr_positions}}',
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
            '{{%fk-hr_department_rel_employee-hr_position_id}}',
            '{{%hr_department_rel_employee}}'
        );

        // drops index for column `hr_position_id`
        $this->dropIndex(
            '{{%idx-hr_department_rel_employee-hr_position_id}}',
            '{{%hr_department_rel_employee}}'
        );
        $this->dropColumn('hr_department_rel_employee', 'hr_position_id');
        $this->dropColumn('hr_department_rel_employee', 'start_date');
        $this->dropColumn('hr_department_rel_employee', 'end_date');
    }
}
