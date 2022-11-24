<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_product_rel_attachment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ref_products}}`
 * - `{{%ref_attachments}}`
 */
class m220602_135943_create_ref_product_rel_attachment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_product_rel_attachment}}', [
            'id' => $this->primaryKey(),
            'ref_product_id' => $this->integer()->notNull(),
            'ref_attachment_id' => $this->integer()->notNull(),
            'main' => $this->integer()->defaultValue(1),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `ref_product_id`
        $this->createIndex(
            '{{%idx-ref_product_rel_attachment-ref_product_id}}',
            '{{%ref_product_rel_attachment}}',
            'ref_product_id'
        );

        // add foreign key for table `{{%ref_products}}`
        $this->addForeignKey(
            '{{%fk-ref_product_rel_attachment-ref_product_id}}',
            '{{%ref_product_rel_attachment}}',
            'ref_product_id',
            '{{%ref_products}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ref_attachment_id`
        $this->createIndex(
            '{{%idx-ref_product_rel_attachment-ref_attachment_id}}',
            '{{%ref_product_rel_attachment}}',
            'ref_attachment_id'
        );

        // add foreign key for table `{{%ref_attachments}}`
        $this->addForeignKey(
            '{{%fk-ref_product_rel_attachment-ref_attachment_id}}',
            '{{%ref_product_rel_attachment}}',
            'ref_attachment_id',
            '{{%ref_attachments}}',
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
            '{{%fk-ref_product_rel_attachment-ref_product_id}}',
            '{{%ref_product_rel_attachment}}'
        );

        // drops index for column `ref_product_id`
        $this->dropIndex(
            '{{%idx-ref_product_rel_attachment-ref_product_id}}',
            '{{%ref_product_rel_attachment}}'
        );

        // drops foreign key for table `{{%ref_attachments}}`
        $this->dropForeignKey(
            '{{%fk-ref_product_rel_attachment-ref_attachment_id}}',
            '{{%ref_product_rel_attachment}}'
        );

        // drops index for column `ref_attachment_id`
        $this->dropIndex(
            '{{%idx-ref_product_rel_attachment-ref_attachment_id}}',
            '{{%ref_product_rel_attachment}}'
        );

        $this->dropTable('{{%ref_product_rel_attachment}}');
    }
}
