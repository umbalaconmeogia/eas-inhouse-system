<?php

use yii\db\Migration;
use app\models\easCrm\Company;

/**
 * Handles the creation for table `eas_company`.
 */
class m161006_104207_create_eas_crm_company_table extends Migration
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
//         $this->initializeData(); // Add eas company data.
    }

    private function createDbTable()
    {
        $this->createTable($this->table, [
            'id' => $this->text(),
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
            'data_status' => $this->integer()->defaultValue(1),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);

        // Add primary key for table `eas_crm_company`
        $this->addPrimaryKey("{$this->table}_pkey", $this->table, 'id');

        // Add comment.
        $this->addCommentOnTable($this->table, 'Company');
        $this->addCommentOnColumn($this->table, 'id', 'Customer id');
        $this->addCommentOnColumn($this->table, 'name', 'Customer name');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Created user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Created timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Updated user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Created timestamp');
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
