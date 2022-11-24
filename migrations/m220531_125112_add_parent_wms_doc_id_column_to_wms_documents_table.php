<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%wms_documents}}`.
 */
class m220531_125112_add_parent_wms_doc_id_column_to_wms_documents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%wms_documents}}', 'parent_wms_doc_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%wms_documents}}', 'parent_wms_doc_id');
    }
}
