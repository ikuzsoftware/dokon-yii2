<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_refresh_tokens}}`.
 */
class m220419_114306_create_user_refresh_tokens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_refresh_tokens}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'token' => $this->string(1000),
            'ip' => $this->string(50),
            'user_agent' => $this->string(1000),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-user_refresh_tokens-urf_user_id',
            'user_refresh_tokens',
            'user_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-user_refresh_tokens-urf_user_id',
            'user_refresh_tokens'
        );
        $this->dropTable('{{%user_refresh_tokens}}');
    }
}
