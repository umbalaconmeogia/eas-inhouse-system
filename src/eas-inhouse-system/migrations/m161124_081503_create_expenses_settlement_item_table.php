<?php

use batsg\migrations\BaseMigrationCreateTable;

/**
 * Handles the creation of table `expenses_settlement_item`.
 */
class m161124_081503_create_expenses_settlement_item_table extends BaseMigrationCreateTable
{
    protected $table = 'expenses_settlement_item';

    /**
     * {@inheritDoc}
     * @see \batsg\migrations\BaseMigrationCreateTable::createDbTable()
     */
    protected function createDbTable()
    {
        $this->createTableWithExtraFields($this->table, [
            'id' => $this->primaryKey(),
            'expenses_settlement_month_id' => [$this->integer()->notNull(), '経費申請月'],
            'expense_date' => [$this->date()->notNull(), '日付'],
            'amount' => [$this->integer()->notNull(), '金額'],
            'payee' => [$this->string()->notNull(), '支払先'],
            'payment_content' => [$this->string()->notNull(), '支払内容'],
            'remarks' => [$this->string(), '備考'],
        ]);

        $this->addComments($this->table, '経費申請項目');
        $this->addForeignKeys($this->table, 'expenses_settlement_month_id', 'expenses_settlement_month', 'id');
    }
}
