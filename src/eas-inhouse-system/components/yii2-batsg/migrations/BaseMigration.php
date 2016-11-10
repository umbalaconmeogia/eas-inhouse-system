<?php
namespace batsg\migrations;

use yii\db\Migration;

/**
 * Base class for migration classes.
 */
class BaseMigration extends Migration
{
    public static function constraintNamePrimaryKey($table, $column)
    {
        return self::constraintName($table, $column, 'pkey');
    }

    public static function constraintNameForeignKey($table, $column)
    {
        return self::constraintName($table, $column, 'fkey');
    }

    public static function constraintNameIndex($table, $column)
    {
        return self::constraintName($table, $column, 'idx');
    }

    /**
     * Make constraint name.
     * @param string $table
     * @param string|string[] $columns
     * @param string $suffix
     * @return string
     */
    private static function constraintName($table, $columns, $suffix)
    {
        if (!is_array($columns)) {
            $columns = [$columns];
        }
        return join('_', array_merge([$table], $columns, [$suffix]));
    }
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

    /**
     * Example usage:
     * <pre>
     *   // tbl_employee.company_id refer to tbl_company.id
     *   $this->addForeignKeys('tbl_employee', 'company_id', 'tbl_company', 'id');
     *
     *   // tbl_employee.company_id refer to tbl_company.id and
     *   // tbl_employee.division_id refer to tbl_division.id
     *   $this->addForeignKeys('tbl_employee', [
     *     ['company_id', 'tbl_company', 'id'],
     *     ['division_id', 'tbl_division', 'id'],
     *   ]);
     * </pre>
     * @param string $table the table that the foreign key constraint will be added to.
     * @param string|array[] $columns A column or
     *                       an array with each element is an array that contains column, refTable, refColumn.
     * @param string $refTable
     * @param string $refColumn
     */
    protected function addForeignKeys($table, $columns, $refTable = NULL, $refColumn = NULL)
    {
        if ($refTable != NULL) {
            $columns = [[$columns, $refTable, $refColumn]];
        }
        foreach ($columns as $columnReference) {
            list($column, $refTable, $refColumn) = $columnReference;
            echo "$column, $refTable, $refColumn\n";
            // Create foreign key.
            $this->addForeignKey(self::constraintNameForeignKey($table, $column),
                $table, $column, $refTable, $refColumn);
            // Create index for foreign key column.
            $this->createIndex(self::constraintNameIndex($table, $column),
                $table, $column);
        }
    }
}