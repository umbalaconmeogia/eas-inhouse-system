<?php

use yii\db\Migration;

/**
 * Handles the creation for table `eas_company_division`.
 * Has foreign keys to the tables:
 *
 * - `eas_company`
 */
class m161006_104239_create_eas_company_division_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'eas_company_division';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->text()->notNull()->unique(),
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

        // creates index for column `id`
        $this->createIndex(
            "idx-{$this->table}-id",
            $this->table,
            'id'
        );

        // add primary key for table `company_division`
        $this->addPrimaryKey(
            "pk_{$this->table}",
            $this->table,
            'id'
        );

        
        // Add comment.
        $this->addCommentOnTable($this->table, 'Company Division');
        $this->addCommentOnColumn($this->table, 'id', 'Company Division id');
        $this->addCommentOnColumn($this->table, 'name', 'Company Division name');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Created user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Created timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Updated user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Created timestamp');

        // creates index for column `company_id`
        $this->createIndex(
            'idx-company_division-company_id',
            $this->table,
            'company_id'
        );

        // add foreign key for table `eas_company`
        $this->addForeignKey(
            'fk-company_division-company_id',
            $this->table,
            'company_id',
            'eas_company',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `eas_company`
        $this->dropForeignKey(
            'fk-company_division-company_id',
            $this->table
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-company_division-company_id',
            $this->table
        );

        $this->dropTable($this->table);
    }
}
