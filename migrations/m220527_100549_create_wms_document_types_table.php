<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wms_document_types}}`.
 */
class m220527_100549_create_wms_document_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wms_document_types}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer(),
            'name' => $this->string(),
            'prefix' => $this->string(),
            'token' => $this->string(),
            'description' => $this->string(),
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
        $this->dropTable('{{%wms_document_types}}');
    }
}
