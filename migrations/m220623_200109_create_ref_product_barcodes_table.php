<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_product_barcodes}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ref_products}}`
 */
class m220623_200109_create_ref_product_barcodes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_product_barcodes}}', [
            'id' => $this->primaryKey(),
            'barcode' => $this->string(),
            'costumer_barcode_id' => $this->smallInteger(),
            'product_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-ref_product_barcodes-product_id}}',
            '{{%ref_product_barcodes}}',
            'product_id'
        );

        // add foreign key for table `{{%ref_products}}`
        $this->addForeignKey(
            '{{%fk-ref_product_barcodes-product_id}}',
            '{{%ref_product_barcodes}}',
            'product_id',
            '{{%ref_products}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ref_products}}`
        $this->dropForeignKey(
            '{{%fk-ref_product_barcodes-product_id}}',
            '{{%ref_product_barcodes}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-ref_product_barcodes-product_id}}',
            '{{%ref_product_barcodes}}'
        );

        $this->dropTable('{{%ref_product_barcodes}}');
    }
}
