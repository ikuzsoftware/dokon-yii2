<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pro_document_rel_process}}`.
 */
class m220601_122619_add_start_date_column_to_pro_document_rel_process_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pro_document_rel_process}}', 'start_date', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pro_document_rel_process}}', 'start_date');
    }
}
