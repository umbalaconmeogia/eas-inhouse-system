<?php

use yii\db\Migration;

/**
 * Handles the creation for table `eas_workhour_project_task`.
 * Has foreign keys to the tables:
 *
 * - `eas_company_project`
 * - `eas_workhour_task`
 */
class m161006_104724_create_eas_workhour_project_task_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'eas_workhour_project_task';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->text()->unique(),
            'project_id' => $this->text()->notNull(),
            'task_id' => $this->text()->notNull(),
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

        // add primary key for table `eas_workhour_project_task`
        $this->addPrimaryKey(
            "pk_{$this->table}",
            $this->table,
            'id'
        );


        // Add comment.
        $this->addCommentOnTable($this->table, 'Workhour Project Task');
        $this->addCommentOnColumn($this->table, 'id', 'Project Task id');
        $this->addCommentOnColumn($this->table, 'project_id', 'Project');
        $this->addCommentOnColumn($this->table, 'task_id', 'Workhour Task');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Created user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Created timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Updated user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Created timestamp');

        // creates index for column `project_id`
        $this->createIndex(
            'idx-workhour_project_task-project_id',
            $this->table,
            'project_id'
        );

        // add foreign key for table `eas_company_project`
        $this->addForeignKey(
            'fk-workhour_project_task-project_id',
            $this->table,
            'project_id',
            'eas_company_project',
            'id',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            'idx-workhour_project_task-task_id',
            $this->table,
            'task_id'
        );

        // add foreign key for table `eas_workhour_task`
        $this->addForeignKey(
            'fk-workhour_project_task-task_id',
            $this->table,
            'task_id',
            'eas_workhour_task',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `eas_company_project`
        $this->dropForeignKey(
            'fk-workhour_project_task-project_id',
            $this->table
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-workhour_project_task-project_id',
            $this->table
        );

        // drops foreign key for table `eas_workhour_task`
        $this->dropForeignKey(
            'fk-workhour_project_task-task_id',
            $this->table
        );

        // drops index for column `task_id`
        $this->dropIndex(
            'idx-workhour_project_task-task_id',
            $this->table
        );

        $this->dropTable($this->table);
    }
}
