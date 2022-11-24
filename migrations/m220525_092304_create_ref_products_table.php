<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_products}}`.
 */
class m220525_092304_create_ref_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull(),
            'ref_category_id' => $this->integer(),
            'ref_product_model_id' => $this->integer(),
//            'barcode' => $this->string('255'),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `ref_category_id`
        $this->createIndex(
            '{{%idx-ref_products-ref_category_id}}',
            '{{%ref_products}}',
            'ref_category_id'
        );
        // add foreign key for table `{{%ref_categories}}`
        $this->addForeignKey(
            '{{%fk-ref_products-ref_category_id}}',
            '{{%ref_products}}',
            'ref_category_id',
            '{{%ref_categories}}',
            'id',
            'RESTRICT'
        );

        // creates index for column `ref_product_model_id`
        $this->createIndex(
            '{{%idx-ref_products-ref_product_model_id}}',
            '{{%ref_products}}',
            'ref_product_model_id'
        );
        // add foreign key for table `{{%ref_product_models}}`
        $this->addForeignKey(
            '{{%fk-ref_products-ref_product_model_id}}',
            '{{%ref_products}}',
            'ref_product_model_id',
            '{{%ref_product_models}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ref_categories}}`
        $this->dropForeignKey(
            '{{%fk-ref_products-ref_category_id}}',
            '{{%ref_products}}'
        );
        // drops index for column `ref_category_id`
        $this->dropIndex(
            '{{%idx-ref_products-ref_category_id}}',
            '{{%ref_products}}'
        );

        // drops foreign key for table `{{%ref_product_models}}`
        $this->dropForeignKey(
            '{{%fk-ref_products-ref_product_model_id}}',
            '{{%ref_products}}'
        );
        // drops index for column `ref_product_model_id`
        $this->dropIndex(
            '{{%idx-ref_products-ref_product_model_id}}',
            '{{%ref_products}}'
        );

        $this->dropTable('{{%ref_products}}');
    }
}
