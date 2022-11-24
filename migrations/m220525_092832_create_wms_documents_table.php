<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wms_documents}}`.
 */
class m220525_092832_create_wms_documents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wms_documents}}', [
            'id' => $this->primaryKey(),
            'doc_type' => $this->smallInteger(),
            'hr_department_id' => $this->integer(),
            'from_hr_department_id' => $this->integer(),
            'to_hr_department_id' => $this->integer(),
            'ref_client_id' => $this->integer(),
            'from_ref_client_id' => $this->integer(),
            'to_ref_client_id' => $this->integer(),
            'doc_number' => $this->string(20),
            'doc_date' => $this->integer(),
            'description' => $this->string('255'),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // create index for column 'hr_department_id'
        $this->createIndex(
            '{{%idx-wms_documents-hr_department_id}}',
            '{{%wms_documents}}',
            'hr_department_id'
        );

        // add foreign key for table '{{%hr_departments}}'
        $this->addForeignKey(
            '{{%fk-wms_documents-hr_department_id}}',
            '{{%wms_documents}}',
            'hr_department_id',
            '{{%hr_departments}}',
            'id',
            'RESTRICT'
        );

        // create index for column 'ref_client_id'
        $this->createIndex(
            '{{%idx-wms_documents-ref_client_id}}',
            '{{%wms_documents}}',
            'ref_client_id'
        );

        // add foreign key for table '{{%ref_clients}}'
        $this->addForeignKey(
            '{{%fk-wms_documents-ref_client_id}}',
            '{{%wms_documents}}',
            'ref_client_id',
            '{{%ref_clients}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table '{{%hr_departments}}'
        $this->dropForeignKey(
            '{{%fk-wms_documents-hr_department_id}}',
            '{{%wms_documents}}'
        );
        // drops index for column 'hr_department_id'
        $this->dropIndex(
            '{{%idx-wms_documents-hr_department_id}}',
            '{{%wms_documents}}'
        );

        // drops foreign key for table '{{%ref_clients}}'
        $this->dropForeignKey(
            '{{%fk-wms_documents-ref_client_id}}',
            '{{%wms_documents}}'
        );
        // drops index for column 'ref_client_id'
        $this->dropIndex(
            '{{%idx-wms_documents-ref_client_id}}',
            '{{%wms_documents}}'
        );

        $this->dropTable('{{%wms_documents}}');
    }
}
