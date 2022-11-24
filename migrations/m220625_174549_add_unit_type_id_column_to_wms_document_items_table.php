<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%wms_document_items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ref_unit_type}}`
 */
class m220625_174549_add_unit_type_id_column_to_wms_document_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%wms_document_items}}', 'unit_type_id', $this->integer());

        // creates index for column `unit_type_id`
        $this->createIndex(
            '{{%idx-wms_document_items-unit_type_id}}',
            '{{%wms_document_items}}',
            'unit_type_id'
        );

        // add foreign key for table `{{%ref_unit_type}}`
        $this->addForeignKey(
            '{{%fk-wms_document_items-unit_type_id}}',
            '{{%wms_document_items}}',
            'unit_type_id',
            '{{%ref_unit_type}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ref_unit_type}}`
        $this->dropForeignKey(
            '{{%fk-wms_document_items-unit_type_id}}',
            '{{%wms_document_items}}'
        );

        // drops index for column `unit_type_id`
        $this->dropIndex(
            '{{%idx-wms_document_items-unit_type_id}}',
            '{{%wms_document_items}}'
        );

        $this->dropColumn('{{%wms_document_items}}', 'unit_type_id');
    }
}
