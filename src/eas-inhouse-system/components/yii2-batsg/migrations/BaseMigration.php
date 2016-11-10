<?php
namespace batsg\migrations;

use yii\db\Migration;

/**
 * Base class for migration classes.
 */
class BaseMigration extends Migration
{
    /**
     * Create a table with specified columns, including the column bellow automatically.
     * <ul>
     * <li>id</li>
     * <li>data_status</li>
     * <li>create_time</li>
     * <li>create_user_id</li>
     * <li>update_time</li>
     * <li>update_user_id</li>
     * </ul>
     *
     * @param string $table
     * @param string[] $columns
     */
    protected function createTableWithExtraFields($table, $columns)
    {
        // Prepare column definition of the table.
        $columns = array_merge(
            [
                'id' => $this->text(),
                'data_status' => $this->integer()->defaultValue(1),
                'created_by' => $this->text(),
                'created_at' => $this->integer(),
                'updated_by' => $this->text(),
                'updated_at' => $this->integer(),
            ],
            $columns
        );
        // Create table.
        $this->createTable($table, $columns);
        // Set primary key.
        $this->addPrimaryKey("{$table}_pkey", $table, 'id');
    }

    /**
     * Add comment on columns and table.
     * @param string $table
     * @param string $tableComment
     * @param array $columnComments Mapping between column name and its comment.
     */
    protected function addComments($table, $tableComment = NULL, $columnComments = [])
    {
        foreach ($columnComments as $column => $comment) {
            $this->addCommentOnColumn($table, $column, $comment);
        }
        if ($tableComment) {
            $this->addCommentOnTable($table, $tableComment);
        }
    }
}