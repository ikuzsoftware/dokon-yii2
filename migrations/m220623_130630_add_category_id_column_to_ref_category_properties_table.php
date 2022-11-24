<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ref_category_properties}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ref_categories}}`
 */
class m220623_130630_add_category_id_column_to_ref_category_properties_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ref_category_properties}}', 'category_id', $this->integer());

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-ref_category_properties-category_id}}',
            '{{%ref_category_properties}}',
            'category_id'
        );

        // add foreign key for table `{{%ref_categories}}`
        $this->addForeignKey(
            '{{%fk-ref_category_properties-category_id}}',
            '{{%ref_category_properties}}',
            'category_id',
            '{{%ref_categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ref_categories}}`
        $this->dropForeignKey(
            '{{%fk-ref_category_properties-category_id}}',
            '{{%ref_category_properties}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-ref_category_properties-category_id}}',
            '{{%ref_category_properties}}'
        );

        $this->dropColumn('{{%ref_category_properties}}', 'category_id');
    }
}
