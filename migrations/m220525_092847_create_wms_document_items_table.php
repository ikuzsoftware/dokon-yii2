<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wms_document_items}}`.
 */
class m220525_092847_create_wms_document_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wms_document_items}}', [
            'id' => $this->primaryKey(),
            'wms_document_id' => $this->integer(),
            'ref_product_id' => $this->integer(),
            'quantity' => $this->integer(),
            'price' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `wms_document_id`
        $this->createIndex(
            '{{%idx-wms_document_items-wms_document_id}}',
            '{{%wms_document_items}}',
            'wms_document_id'
        );
        // add foreign key for table `{{%wms_documents}}`
        $this->addForeignKey(
            '{{%fk-wms_document_items-wms_document_id}}',
            '{{%wms_document_items}}',
            'wms_document_id',
            '{{%wms_documents}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ref_product_id`
        $this->createIndex(
            '{{%idx-wms_document_items-ref_product_id}}',
            '{{%wms_document_items}}',
            'ref_product_id'
        );
        // add foreign key for table `{{%ref_products}}`
        $this->addForeignKey(
            '{{%fk-wms_document_items-ref_product_id}}',
            '{{%wms_document_items}}',
            'ref_product_id',
            '{{%ref_products}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%wms_documents}}`
        $this->dropForeignKey(
            '{{%fk-wms_document_items-wms_document_id}}',
            '{{%wms_document_items}}'
        );
        // drops index for column `wms_document_id`
        $this->dropIndex(
            '{{%idx-wms_document_items-wms_document_id}}',
            '{{%wms_document_items}}'
        );

        // drops foreign key for table `{{%ref_products}}`
        $this->dropForeignKey(
            '{{%fk-wms_document_items-ref_product_id}}',
            '{{%wms_document_items}}'
        );
        // drops index for column `ref_product_id`
        $this->dropIndex(
            '{{%idx-wms_document_items-ref_product_id}}',
            '{{%wms_document_items}}'
        );
        $this->dropTable('{{%wms_document_items}}');
    }
}
