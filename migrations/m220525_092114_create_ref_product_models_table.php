<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_product_models}}`.
 */
class m220525_092114_create_ref_product_models_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_product_models}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull(),
            'description' => $this->string('255'),
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
        $this->dropTable('{{%ref_product_models}}');
    }
}
