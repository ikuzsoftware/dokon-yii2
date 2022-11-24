<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_departments}}`.
 */
class m220419_013431_create_hr_departments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_departments}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'parent_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
        $this->createIndex('idx-hr_departments-parent_id', '{{%hr_departments}}', 'parent_id');
        $this->addForeignKey(
            'fk-hr_departments-parent_id',
            'hr_departments',
            'parent_id',
            '{{%hr_departments}}',
            'id',
            'RESTRICT',
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        // drops foreign key for table `{{%hr_departments}}`
        $this->dropForeignKey(
            '{{%fk-hr_departments-parent_id}}',
            '{{%hr_departments}}'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-hr_departments-parent_id}}',
            '{{%hr_departments}}'
        );
        $this->dropTable('{{%hr_departments}}');
    }
}
