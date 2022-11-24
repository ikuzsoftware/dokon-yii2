<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ref_products}}`.
 */
class m220602_123743_add_type_column_to_ref_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ref_products}}', 'type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ref_products}}', 'type');
    }
}
