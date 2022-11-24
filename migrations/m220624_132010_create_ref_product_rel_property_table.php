<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_product_rel_property}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ref_products}}`
 * - `{{%ref_category_properties}}`
 */
class m220624_132010_create_ref_product_rel_property_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_product_rel_property}}', [
            'id' => $this->primaryKey(),
            'ref_product_id' => $this->integer(),
            'ref_property_id' => $this->integer(),
            'value' => $this->string(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `ref_product_id`
        $this->createIndex(
            '{{%idx-ref_product_rel_property-ref_product_id}}',
            '{{%ref_product_rel_property}}',
            'ref_product_id'
        );

        // add foreign key for table `{{%ref_products}}`
        $this->addForeignKey(
            '{{%fk-ref_product_rel_property-ref_product_id}}',
            '{{%ref_product_rel_property}}',
            'ref_product_id',
            '{{%ref_products}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ref_property_id`
        $this->createIndex(
            '{{%idx-ref_product_rel_property-ref_property_id}}',
            '{{%ref_product_rel_property}}',
            'ref_property_id'
        );

        // add foreign key for table `{{%ref_category_properties}}`
        $this->addForeignKey(
            '{{%fk-ref_product_rel_property-ref_property_id}}',
            '{{%ref_product_rel_property}}',
            'ref_property_id',
            '{{%ref_category_properties}}',
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
            '{{%fk-ref_product_rel_property-ref_product_id}}',
            '{{%ref_product_rel_property}}'
        );

        // drops index for column `ref_product_id`
        $this->dropIndex(
            '{{%idx-ref_product_rel_property-ref_product_id}}',
            '{{%ref_product_rel_property}}'
        );

        // drops foreign key for table `{{%ref_category_properties}}`
        $this->dropForeignKey(
            '{{%fk-ref_product_rel_property-ref_property_id}}',
            '{{%ref_product_rel_property}}'
        );

        // drops index for column `ref_property_id`
        $this->dropIndex(
            '{{%idx-ref_product_rel_property-ref_property_id}}',
            '{{%ref_product_rel_property}}'
        );

        $this->dropTable('{{%ref_product_rel_property}}');
    }
}
