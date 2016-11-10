<?php

use batsg\migrations\BaseMigration;

/**
 * Handles the creation for table `eas_company_employee`.
 * Has foreign keys to the tables:
 *
 * - `eas_company`
 * - `eas_company_division`
 */
class m161006_104336_create_eas_employee_table extends BaseMigration
{
    /**
     * @var string
     */
    private $table = 'eas_crm_employee';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTableWithExtraFields($this->table, [
            'company_id' => $this->text()->notNull(),
            'division_id' => $this->text(),
            'employee_number' => $this->text()->unique(),
            'name' => $this->text()->notNull(),
            'name_kana' => $this->text(),
            'gender' => $this->integer(),
            'tel' => $this->text(),
            'tel_ext' => $this->text(),
            'fax' => $this->text(),
            'mobile' => $this->text(),
            'email' => $this->text(),
            'title' => $this->text(),
            'remarks' => $this->text(),
        ]);

        $this->addComments($this->table, 'Employee', [
            'company_id' => 'Company',
            'division_id' => 'Division',
            'name' => 'Employee name',
        ]);

        $this->addForeignKeys($this->table, [
            ['company_id', 'eas_crm_company', 'id'],
            ['division_id', 'eas_crm_division', 'id'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
