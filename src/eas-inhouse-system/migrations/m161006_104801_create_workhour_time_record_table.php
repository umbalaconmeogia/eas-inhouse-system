<?php

use yii\db\Migration;

/**
 * Handles the creation for table `workhour_time_record`.
 * Has foreign keys to the tables:
 *
 * - `workhour_project_task`
 * - `company_employee`
 */
class m161006_104801_create_workhour_time_record_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'workhour_time_record';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('workhour_time_record', [
            'id' => $this->text()->notNull()->unique(),
            'project_task_id' => $this->text()->notNull(),
            'working_time' => $this->float(),
            'working_date' => $this->date(),
            'employee_id' => $this->text()->notNull(),
            'data_status' => $this->integer(),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);
        // Add comment.
        $this->addCommentOnTable($this->table, 'Workhour Time Record');
        $this->addCommentOnColumn($this->table, 'id', 'Time Record id');
        $this->addCommentOnColumn($this->table, 'project_task_id', 'Project Task');
        $this->addCommentOnColumn($this->table, 'working_time', 'Working Time');
        $this->addCommentOnColumn($this->table, 'working_date', 'Working Date');
        $this->addCommentOnColumn($this->table, 'employee_id', 'Employee');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Created user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Created timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Updated user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Created timestamp');

        // creates index for column `project_task_id`
        $this->createIndex(
            'idx-workhour_time_record-project_task_id',
            'workhour_time_record',
            'project_task_id'
        );

        // add foreign key for table `workhour_project_task`
        $this->addForeignKey(
            'fk-workhour_time_record-project_task_id',
            'workhour_time_record',
            'project_task_id',
            'workhour_project_task',
            'id',
            'CASCADE'
        );

        // creates index for column `employee_id`
        $this->createIndex(
            'idx-workhour_time_record-employee_id',
            'workhour_time_record',
            'employee_id'
        );

        // add foreign key for table `company_employee`
        $this->addForeignKey(
            'fk-workhour_time_record-employee_id',
            'workhour_time_record',
            'employee_id',
            'company_employee',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `workhour_project_task`
        $this->dropForeignKey(
            'fk-workhour_time_record-project_task_id',
            'workhour_time_record'
        );

        // drops index for column `project_task_id`
        $this->dropIndex(
            'idx-workhour_time_record-project_task_id',
            'workhour_time_record'
        );

        // drops foreign key for table `company_employee`
        $this->dropForeignKey(
            'fk-workhour_time_record-employee_id',
            'workhour_time_record'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            'idx-workhour_time_record-employee_id',
            'workhour_time_record'
        );

        $this->dropTable('workhour_time_record');
    }
}
