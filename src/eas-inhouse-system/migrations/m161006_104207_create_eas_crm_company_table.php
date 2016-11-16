<?php

use app\models\easCrm\Company;
use batsg\migrations\BaseMigration;

/**
 * Handles the creation for table `eas_company`.
 */
class m161006_104207_create_eas_crm_company_table extends BaseMigration
{
    /**
     * @var string
     */
    private $table = 'eas_crm_company';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTableWithExtraFields($this->table, [
            'name' => $this->text()->notNull(),
            'name_kana' => $this->text(),
            'name_short' => $this->text(),
            'tel' => $this->text(),
            'fax' => $this->text(),
            'email' => $this->text(),
            'zip_code' => $this->text(),
            'address1' => $this->text(),
            'address2' => $this->text(),
            'iso_country_code' => $this->text(),
            'homepage' => $this->text(),
            'industry' => $this->text(),
            'remarks' => $this->text(),
            'this_company' => $this->integer()->defaultValue(0),
        ]);

        $this->addComments($this->table, 'Company', [
            'name' => 'Company name',
            'iso_country_code' => '2 character Country code',
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
