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
            'iso_country_code' => $this->text(),
            'homepage' => $this->text(),
            'remarks' => $this->text(),
        ]);

        $this->addForeignKeys($this->table, 'company_id', 'eas_crm_company', 'id');

        $this->addComments($this->table, 'Division', [
            'name' => 'Division name',
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
