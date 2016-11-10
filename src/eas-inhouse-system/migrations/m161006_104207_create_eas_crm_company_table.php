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
        $this->createDbTable();
        $this->initializeData(); // Add eas company data.
    }

    private function createDbTable()
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
            'homepage' => $this->text(),
            'industry' => $this->text(),
            'remarks' => $this->text(),
            'is_eas' => $this->integer()->defaultValue(0),
        ]);

        $this->addComments($this->table, 'Company', [
            'name' => 'Customer name',
        ]);
    }

    private function initializeData()
    {
        $company = new Company([
            'name' => '株式会社 EVA',
            'name_kana' => 'カ）イーヴィーエー',
            'name_short' => 'EVA',
            'tel' => '090-2007-9057',
            'email' => 'info@evolable.asia',
            'zip_code' => '182-0024',
            'address1' => '東京都調布市布田2-9-5',
            'address2' => '#201',
            'homepage' => 'http://eas.evolable.asia',
            'remarks' => '本店住所は調布市',
            'industry' => 'IT',
            'is_eas' => 1,
        ]);

        $company->saveThrowError();
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
