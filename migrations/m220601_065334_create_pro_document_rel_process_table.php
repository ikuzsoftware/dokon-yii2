<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pro_document_rel_process}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%pro_documents}}`
 * - `{{%pro_process}}`
 */
class m220601_065334_create_pro_document_rel_process_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pro_document_rel_process}}', [
            'id' => $this->primaryKey(),
            'pro_document_id' => $this->integer()->notNull(),
            'pro_process_id' => $this->integer()->notNull(),
            'prose_order' => $this->integer(),
            'description' => $this->text(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `pro_document_id`
        $this->createIndex(
            '{{%idx-pro_document_rel_process-pro_document_id}}',
            '{{%pro_document_rel_process}}',
            'pro_document_id'
        );

        // add foreign key for table `{{%pro_documents}}`
        $this->addForeignKey(
            '{{%fk-pro_document_rel_process-pro_document_id}}',
            '{{%pro_document_rel_process}}',
            'pro_document_id',
            '{{%pro_documents}}',
            'id',
            'CASCADE'
        );

        // creates index for column `pro_process_id`
        $this->createIndex(
            '{{%idx-pro_document_rel_process-pro_process_id}}',
            '{{%pro_document_rel_process}}',
            'pro_process_id'
        );

        // add foreign key for table `{{%pro_process}}`
        $this->addForeignKey(
            '{{%fk-pro_document_rel_process-pro_process_id}}',
            '{{%pro_document_rel_process}}',
            'pro_process_id',
            '{{%pro_process}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%pro_documents}}`
        $this->dropForeignKey(
            '{{%fk-pro_document_rel_process-pro_document_id}}',
            '{{%pro_document_rel_process}}'
        );

        // drops index for column `pro_document_id`
        $this->dropIndex(
            '{{%idx-pro_document_rel_process-pro_document_id}}',
            '{{%pro_document_rel_process}}'
        );

        // drops foreign key for table `{{%pro_process}}`
        $this->dropForeignKey(
            '{{%fk-pro_document_rel_process-pro_process_id}}',
            '{{%pro_document_rel_process}}'
        );

        // drops index for column `pro_process_id`
        $this->dropIndex(
            '{{%idx-pro_document_rel_process-pro_process_id}}',
            '{{%pro_document_rel_process}}'
        );

        $this->dropTable('{{%pro_document_rel_process}}');
    }
}
