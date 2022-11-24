<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pro_documents}}`.
 */
class m220601_064302_create_pro_documents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pro_documents}}', [
            'id' => $this->primaryKey(),
            'doc_date' => $this->integer(),
            'doc_number' => $this->string(),
            'description' => $this->text(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pro_documents}}');
    }
}
