<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_clients}}`.
 */
class m220525_092315_create_ref_clients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_clients}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull(),
            'address' => $this->string('255'),
            'phone' => $this->string('255'),
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
        $this->dropTable('{{%ref_clients}}');
    }
}
