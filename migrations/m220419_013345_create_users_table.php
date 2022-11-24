<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m220419_013345_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'hr_employee_id' => $this->integer(),
            'username' => $this->string(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
        $this->createIndex(
            'idx-users-hr_employee_id',
            '{{%users}}',
            'hr_employee_id'
        );

        $this->addForeignKey(
            'fk-users-hr_employee_id',
            '{{%users}}',
            'hr_employee_id',
            '{{%hr_employees}}',
            'id',
            'RESTRICT',
        );
        /**
         * Insert Default Admin User
         * Login: admin
         * Pass: 123456
         */
        $this->insert('users', [
            'id' => 1,
            'username' => 'admin',
            'auth_key' => 'qSn5DH7kIedrNo1YXIpZFNz-f67qWF8U',
            'password_hash' => '$2y$13$aZ/f2Da2PefDCBMfdpywEue5mHekRQA2lh12Bt/B0Ziuy94gxBU0q',
            'password_reset_token' => null,
            'status' => 1,
            'created_at' => 1505282484,
            'updated_at' => 1505282484,
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-users-hr_employee_id',
            '{{%users}}'
        );
        $this->dropForeignKey(
            'fk-users-hr_employee_id',
            '{{%users}}'
        );
        $this->dropTable('{{%users}}');
    }
}
