<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wms_item_balance_status}}`.
 */
class m220531_040458_create_wms_item_balance_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wms_item_balance_status}}', [
            'id' => $this->primaryKey(),
            'hr_department_id' => $this->integer(),
            'ref_product_id' => $this->integer(),
            'quantity' => $this->integer(),
            'inventory_balance' => $this->integer(),
            'inventory_date' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `ref_product_id`
        $this->createIndex(
            '{{%idx-wms_item_balance_status-ref_product_id}}',
            '{{%wms_item_balance_status}}',
            'ref_product_id'
        );
        // add foreign key for table `{{%ref_products}}`
        $this->addForeignKey(
            '{{%fk-wms_item_balance_status-ref_product_id}}',
            '{{%wms_item_balance_status}}',
            'ref_product_id',
            '{{%ref_products}}',
            'id',
            'RESTRICT'
        );

        // creates index for column `hr_department_id`
        $this->createIndex(
            '{{%idx-wms_item_balance_status-hr_department_id}}',
            '{{%wms_item_balance_status}}',
            'hr_department_id'
        );
        // add foreign key for table `{{%hr_departments}}`
        $this->addForeignKey(
            '{{%fk-wms_item_balance_status-hr_department_id}}',
            '{{%wms_item_balance_status}}',
            'hr_department_id',
            '{{%hr_departments}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wms_item_balance_status}}');
    }
}
