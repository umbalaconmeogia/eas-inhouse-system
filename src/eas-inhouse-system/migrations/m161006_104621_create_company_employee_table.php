<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_employee`.
 * Has foreign keys to the tables:
 *
 * - `company_division`
 */
class m161006_104621_create_company_employee_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'company_employee';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('company_employee', [
            'id' => $this->text()->notNull()->unique(),
            'name' => $this->text(),
            'division_id' => $this->text()->notNull(),
            'data_status' => $this->integer(),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `id`
        $this->createIndex(
            'idx-company_employee-id',
            $this->table,
            'id'
        );

        // add primary key for table `company_employee`
        $this->addPrimaryKey(
            'pk-company_employee-id',
            $this->table,
            'id'
        );

        
        // Add comment.
        $this->addCommentOnTable($this->table, 'Company Employee');
        $this->addCommentOnColumn($this->table, 'id', 'Company Employee id');
        $this->addCommentOnColumn($this->table, 'name', 'Company Employee name');
        $this->addCommentOnColumn($this->table, 'division_id', 'Company Division');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Created user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Created timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Updated user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Created timestamp');

        // creates index for column `division_id`
        $this->createIndex(
            'idx-company_employee-division_id',
            'company_employee',
            'division_id'
        );

        // add foreign key for table `company_division`
        $this->addForeignKey(
            'fk-company_employee-division_id',
            'company_employee',
            'division_id',
            'company_division',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `company_division`
        $this->dropForeignKey(
            'fk-company_employee-division_id',
            'company_employee'
        );

        // drops index for column `division_id`
        $this->dropIndex(
            'idx-company_employee-division_id',
            'company_employee'
        );

        $this->dropTable('company_employee');
    }
}
