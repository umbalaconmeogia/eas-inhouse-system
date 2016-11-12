<?php

use batsg\migrations\BaseMigration;

/**
 * Handles the creation for table `eas_company_employee`.
 * Has foreign keys to the tables:
 *
 * - `eas_company`
 * - `eas_company_division`
 */
class m161006_104336_create_eas_crm_employee_table extends BaseMigration
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
            'first_name' => $this->text()->notNull(),
            'middle_name' => $this->text()->notNull(),
            'last_name' => $this->text()->notNull(),
            'first_name_kana' => $this->text(),
            'last_name_kana' => $this->text(),
            'middle_name_kana' => $this->text(),
            'gender' => $this->integer(),
            'tel' => $this->text(),
            'tel_ext' => $this->text(),
            'fax' => $this->text(),
            'mobile' => $this->text(),
            'email' => $this->text(),
            'job_title' => $this->text(),
            'zip_code' => $this->text(),
            'address1' => $this->text(),
            'address2' => $this->text(),
            'iso_country_code' => $this->text(),
            'remarks' => $this->text(),
        ]);

        $this->addComments($this->table, 'Employee', [
            'company_id' => 'Company',
            'division_id' => 'Division',
            'iso_country_code' => '2 character Country code',
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
