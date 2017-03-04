<?php

use batsg\migrations\BaseMigrationCreateTable;

/**
 * Handles the creation of table `expenses_settlement_transport`.
 */
class m161124_081504_create_expenses_settlement_transport_table extends BaseMigrationCreateTable
{
    protected $table = 'expenses_settlement_transport';

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
            'transportation' => [$this->string()->notNull(), '交通手段'],
            'section_from' => [$this->string()->notNull(), '空間::出発'],
            'section_to' => [$this->string()->notNull(), '空間::到着'],
            'type' => [$this->smallInteger()->notNull()->defaultValue(1), '片／復'],
            'remarks' => [$this->string(), '備考'],
        ]);

        $this->addComments($this->table, '経費申請項目');
        $this->addForeignKeys($this->table, 'expenses_settlement_month_id', 'expenses_settlement_month', 'id');
    }
}
