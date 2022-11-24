<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pro_document_rel_process}}`.
 */
class m220601_122635_add_end_date_column_to_pro_document_rel_process_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pro_document_rel_process}}', 'end_date', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pro_document_rel_process}}', 'end_date');
    }
}
