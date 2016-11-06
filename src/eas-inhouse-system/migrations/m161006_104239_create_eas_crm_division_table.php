<?php

use yii\db\Migration;
use app\models\easCompany\Company;
use yii\base\Exception;
use app\models\easCompany\Division;
use yii\base\Object;

/**
 * Handles the creation for table `eas_company_division`.
 * Has foreign keys to the tables:
 *
 * - `eas_company`
 */
class m161006_104239_create_eas_crm_division_table extends Migration
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
//         $this->initializeData(); // Add eas company data.
    }

    private function createDbTable()
    {
        $this->createTable($this->table, [
            'id' => $this->text(),
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
            'data_status' => $this->integer()->defaultValue(1),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);

        // Add primary key for table `crm_division`
        $this->addPrimaryKey("{$this->table}_pkey", $this->table, 'id');

//         // creates index for column `company_id`
//         $this->createIndex(
//             'idx-eas_company_division-company_id',
//             $this->table,
//             'company_id'
//         );

        // add foreign key for table `eas_company`
        $this->addForeignKey(
            'eas_crm_division-company_id_fkey',
            $this->table,
            'company_id',
            'eas_crm_company',
            'id'
        );
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
//         // drops foreign key for table `eas_company`
//         $this->dropForeignKey(
//             'fk-eas_company_division-company_id',
//             $this->table
//         );

//         // drops index for column `company_id`
//         $this->dropIndex(
//             'idx-eas_company_division-company_id',
//             $this->table
//         );

        $this->dropTable($this->table);
    }
}
