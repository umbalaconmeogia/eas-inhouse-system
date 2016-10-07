<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_customer`.
 */
class m161006_104207_create_company_customer_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'company_customer';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('company_customer', [
            'id' => $this->text()->notNull()->unique(),
            'name' => $this->text(),
            'data_status' => $this->integer(),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `id`
        $this->createIndex(
            'idx-company_customer-id',
            $this->table,
            'id'
        );

        // add primary key for table `company_customer`
        $this->addPrimaryKey(
            'pk-company_customer-id',
            $this->table,
            'id'
        );

        
        // Add comment.
        $this->addCommentOnTable($this->table, 'Company Customer');
        $this->addCommentOnColumn($this->table, 'id', 'Customer id');
        $this->addCommentOnColumn($this->table, 'name', 'Customer name');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Created user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Created timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Updated user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Created timestamp');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('company_customer');
    }
}
