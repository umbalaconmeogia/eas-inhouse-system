<?php

use batsg\migrations\BaseMigration;

/**
 * Handles the creation for table `eas_company_project`.
 * Has foreign keys to the tables:
 *
 * - `eas_company`
 */
class m161006_104621_create_eas_project_table extends BaseMigration
{
    /**
     * @var string
     */
    private $table = 'eas_project';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTableWithExtraFields($this->table, [
            'company_id' => $this->text()->notNull(),
            'division_id' => $this->text(),
            'name' => $this->text()->notNull(),
            'start_date' => $this->date(),
            'finish_date' => $this->date(),
        ]);

        $this->addComments($this->table, 'Project', [
            'name' => 'Project name',
            'company_id' => 'Company',
            'division_id' => 'Division',
            'start_date' => 'Project start date',
            'finish_date' => 'Project finish date',
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
