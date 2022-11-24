<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%wms_document_items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ref_currency_type}}`
 */
class m220625_174109_add_currency_type_id_column_to_wms_document_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%wms_document_items}}', 'currency_type_id', $this->integer());

        // creates index for column `currency_type_id`
        $this->createIndex(
            '{{%idx-wms_document_items-currency_type_id}}',
            '{{%wms_document_items}}',
            'currency_type_id'
        );

        // add foreign key for table `{{%ref_currency_type}}`
        $this->addForeignKey(
            '{{%fk-wms_document_items-currency_type_id}}',
            '{{%wms_document_items}}',
            'currency_type_id',
            '{{%ref_currency_type}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ref_currency_type}}`
        $this->dropForeignKey(
            '{{%fk-wms_document_items-currency_type_id}}',
            '{{%wms_document_items}}'
        );

        // drops index for column `currency_type_id`
        $this->dropIndex(
            '{{%idx-wms_document_items-currency_type_id}}',
            '{{%wms_document_items}}'
        );

        $this->dropColumn('{{%wms_document_items}}', 'currency_type_id');
    }
}
