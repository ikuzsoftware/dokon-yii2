<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_attachments}}`.
 */
class m220602_124001_create_ref_attachments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_attachments}}', [
            'id' => $this->primaryKey(),
            'path' => $this->string(),
            'size' => $this->integer(),
            'name' => $this->string(),
            'type' => $this->string(),
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
        $this->dropTable('{{%ref_attachments}}');
    }
}
