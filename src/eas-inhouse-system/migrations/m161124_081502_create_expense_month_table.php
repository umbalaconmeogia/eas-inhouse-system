<?php

use batsg\migrations\BaseMigrationCreateTable;

/**
 * Handles the creation of table `expense_month`.
 */
class m161124_081502_create_expense_month_table extends BaseMigrationCreateTable
{
    protected $table = 'expense_month';

    /**
     * {@inheritDoc}
     * @see \batsg\migrations\BaseMigrationCreateTable::createDbTable()
     */
    protected function createDbTable()
    {
        $this->createTableWithExtraFields($this->table, [
            'id' => $this->primaryKey(),
            'month' => [$this->date()->notNull(), '月'],
            'user_id' => [$this->integer()->notNull(), 'ユーザ'],
        ]);

        $this->addComments($this->table, '経費申請月');
        $this->addForeignKeys($this->table, 'user_id', 'login_user', 'id');
    }
}
