<?php

use batsg\migrations\BaseMigrationCreateTable;

/**
 * Handles the creation of table `expense_settlement_item`.
 */
class m161124_081503_create_expense_settlement_item_table extends BaseMigrationCreateTable
{
    protected $table = 'expense_settlement_item';

    /**
     * {@inheritDoc}
     * @see \batsg\migrations\BaseMigrationCreateTable::createDbTable()
     */
    protected function createDbTable()
    {
        $this->createTableWithExtraFields($this->table, [
            'id' => $this->primaryKey(),
            'expense_settlement_month_id' => [$this->integer()->notNull(), '経費申請月'],
            'date' => [$this->date()->notNull(), '日付'],
            'amount' => [$this->integer()->notNull(), '金額'],
            'store' => [$this->string()->notNull(), '店舗'],
            'content' => [$this->string()->notNull(), '内容'],
            'remarks' => [$this->string()->notNull(), '備考'],
        ]);

        $this->addComments($this->table, '経費申請項目');
        $this->addForeignKeys($this->table, 'expense_settlement_month_id', 'expense_settlement_month', 'id');
    }
}
