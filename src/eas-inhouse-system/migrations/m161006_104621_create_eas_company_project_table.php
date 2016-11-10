<?php

use yii\db\Migration;

/**
 * Handles the creation for table `eas_company_project`.
 * Has foreign keys to the tables:
 *
 * - `eas_company`
 */
class m161006_104621_create_eas_company_project_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'eas_company_project';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->text()->unique(),
            'name' => $this->text()->notNull(),
            'company_id' => $this->text()->notNull(),
            'data_status' => $this->integer()->defaultValue(1),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `id`
        $this->createIndex(
            "idx-{$this->table}-id",
            $this->table,
            'id'
        );

        // add primary key for table `company_project`
        $this->addPrimaryKey(
            "pk_{$this->table}",
            $this->table,
            'id'
        );


        // Add comment.
        $this->addCommentOnTable($this->table, 'Company Project');
        $this->addCommentOnColumn($this->table, 'id', 'Company Project id');
        $this->addCommentOnColumn($this->table, 'name', 'Company Project name');
        $this->addCommentOnColumn($this->table, 'company_id', 'Company');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Created user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Created timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Updated user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Created timestamp');

        // creates index for column `company_id`
        $this->createIndex(
            'idx-company_project-company_id',
            $this->table,
            'company_id'
        );

        // add foreign key for table `eas_company`
        $this->addForeignKey(
            'fk-company_project-company_id',
            $this->table,
            'company_id',
            'eas_company_company',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `eas_company`
        $this->dropForeignKey(
            'fk-company_project-company_id',
            $this->table
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-company_project-company_id',
            $this->table
        );

        $this->dropTable($this->table);
    }
}
