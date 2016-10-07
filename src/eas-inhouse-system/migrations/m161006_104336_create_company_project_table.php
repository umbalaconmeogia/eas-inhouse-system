<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_project`.
 * Has foreign keys to the tables:
 *
 * - `company_customer`
 */
class m161006_104336_create_company_project_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'company_project';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('company_project', [
            'id' => $this->text()->notNull()->unique(),
            'name' => $this->text(),
            'customer_id' => $this->text()->notNull(),
            'data_status' => $this->integer(),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `id`
        $this->createIndex(
            'idx-company_project-id',
            $this->table,
            'id'
        );

        // add primary key for table `company_project`
        $this->addPrimaryKey(
            'pk-company_project-id',
            $this->table,
            'id'
        );

        
        // Add comment.
        $this->addCommentOnTable($this->table, 'Company Project');
        $this->addCommentOnColumn($this->table, 'id', 'Company Project id');
        $this->addCommentOnColumn($this->table, 'name', 'Company Project name');
        $this->addCommentOnColumn($this->table, 'customer_id', 'Project Owner');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Created user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Created timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Updated user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Created timestamp');

        // creates index for column `customer_id`
        $this->createIndex(
            'idx-company_project-customer_id',
            'company_project',
            'customer_id'
        );

        // add foreign key for table `company_customer`
        $this->addForeignKey(
            'fk-company_project-customer_id',
            'company_project',
            'customer_id',
            'company_customer',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `company_customer`
        $this->dropForeignKey(
            'fk-company_project-customer_id',
            'company_project'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            'idx-company_project-customer_id',
            'company_project'
        );

        $this->dropTable('company_project');
    }
}
