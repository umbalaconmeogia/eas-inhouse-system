<?php

use app\models\easCrm\Company;
use app\models\easCrm\Division;
use batsg\migrations\BaseMigration;
use yii\base\Exception;

/**
 * Handles the creation for table `eas_company_division`.
 * Has foreign keys to the tables:
 *
 * - `eas_company`
 */
class m161006_104239_create_eas_crm_division_table extends BaseMigration
{
    /**
     * @var string
     */
    private $table = 'eas_crm_division';

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
            'company_id' => $this->text()->notNull(),
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
            'remarks' => $this->text(),
        ]);

        $this->addForeignKeys($this->table, 'company_id', 'eas_crm_company', 'id');
    }

    private function initializeData()
    {
        // Get EAS company info.
        $company = Company::findOne(['is_eas' => 1]);
        if (!$company) {
            throw new Exception("Error finding EAS company.");
        }
        // Create JP divisions.
        (new Division([
                'company_id' => $company->id,
                'name' => 'JP',
                'tel' => '090-2007-9057',
                'email' => 'thanhtt@evolable.asia',
                'zip_code' => '105-6219',
                'address1' => '東京都港区愛宕2-5-1',
                'address2' => '愛宕グリーンヒルズMORIタワー19F',
                'remarks' => 'エボラブルアジア同オフィス',
        ]))->saveThrowError();
        // Create VN divisions.
        (new Division([
                'company_id' => $company->id,
                'name' => 'VN',
                'address1' => '9F Viet A Building, Duy Tan Street',
                'address2' => 'Cau Giay District, Ha Noi, Vietnam',
                'remarks' => 'エボラブルアジア　ハノイ　オフィス',
        ]))->saveThrowError();
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
