<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_categories}}`.
 */
class m220525_092253_create_ref_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ref_categories}}');
    }
}
