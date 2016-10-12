<?php

use yii\db\Migration;

/**
 * Handles the creation for table `eas_company`.
 */
class m161006_104207_create_eas_company_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'eas_company';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->text()->notNull()->unique(),
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
            'is_eas' => $this->integer(),
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

        // add primary key for table `eas_company`
        $this->addPrimaryKey(
            "pk_{$this->table}",
            $this->table,
            'id'
        );
        
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

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
