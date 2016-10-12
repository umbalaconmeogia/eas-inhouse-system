<?php

use yii\db\Migration;

/**
 * Handles the creation for table `eas_workhour_task`.
 */
class m161006_104658_create_eas_workhour_task_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'eas_workhour_task';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->text()->notNull()->unique(),
            'name' => $this->text()->notNull(),
            'display_order' => $this->integer(),
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

        // add primary key for table `eas_workhour_task`
        $this->addPrimaryKey(
            "pk_{$this->table}",
            $this->table,
            'id'
        );

        
        // Add comment.
        $this->addCommentOnTable($this->table, 'Workhour Task');
        $this->addCommentOnColumn($this->table, 'id', 'Task id');
        $this->addCommentOnColumn($this->table, 'name', 'Task name');
        $this->addCommentOnColumn($this->table, 'display_order', 'Task Display Order');
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
        $this->dropTable($this->table);
    }
}
