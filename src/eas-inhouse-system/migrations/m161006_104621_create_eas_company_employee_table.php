<?php

use yii\db\Migration;

/**
 * Handles the creation for table `eas_company_employee`.
 * Has foreign keys to the tables:
 *
 * - `eas_company`
 * - `eas_company_division`
 */
class m161006_104621_create_eas_company_employee_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'eas_company_employee';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->text()->unique(),
            'company_id' => $this->text()->notNull(),
            'division_id' => $this->text(),
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
            'data_status' => $this->integer()->defaultValue(1),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `id`
        $this->createIndex(
            "idx-{$this->table}-id",
            $this->table,
            'id'
        );

        // add primary key for table `eas_company_employee`
        $this->addPrimaryKey(
            "pk_{$this->table}",
            $this->table,
            'id'
        );


        // Add comment.
        $this->addCommentOnTable($this->table, 'Company Employee');
        $this->addCommentOnColumn($this->table, 'id', 'Company Employee id');
        $this->addCommentOnColumn($this->table, 'name', 'Company Employee name');
        $this->addCommentOnColumn($this->table, 'division_id', 'Company Division');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Created user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Created timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Updated user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Created timestamp');

        // creates index for column `company_id`
        $this->createIndex(
            'idx-company_employee-company_id',
            $this->table,
            'company_id'
        );

        // add foreign key for table `eas_company_employee`
        $this->addForeignKey(
            'fk-company_employee-company_id',
            $this->table,
            'company_id',
            'eas_company',
            'id',
            'CASCADE'
        );

        // creates index for column `division_id`
        $this->createIndex(
            'idx-company_employee-division_id',
            $this->table,
            'division_id'
        );

        // add foreign key for table `eas_company_employee`
        $this->addForeignKey(
            'fk-company_employee-division_id',
            $this->table,
            'division_id',
            'eas_company_division',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `eas_company_division`
        $this->dropForeignKey(
            'fk-company_employee-division_id',
            $this->table
        );

        // drops index for column `division_id`
        $this->dropIndex(
            'idx-company_employee-division_id',
            $this->table
        );

        // drops foreign key for table `eas_company`
        $this->dropForeignKey(
            'fk-company_employee-company_id',
            $this->table
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-company_employee-company_id',
            $this->table
        );


        $this->dropTable($this->table);
    }
}
