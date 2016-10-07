<?php

use yii\db\Migration;

/**
 * Handles the creation for table `system_user_login`.
 */
class m161006_103855_create_system_user_login_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'system_user_login';
    
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('system_user_login', [
            'id' => $this->text()->notNull()->unique(),
            'account' => $this->text()->notNull()->unique(),
            'password_encryption' => $this->text(),
            'access_token' => $this->text(),
            'auth_key' => $this->text(),
            'data_status' => $this->integer(),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `id`
        $this->createIndex(
            'idx-system_user_login-id',
            $this->table,
            'id'
        );

        // add primary key for table `system_user_login`
        $this->addPrimaryKey(
            'pk-system_user_login-id',
            $this->table,
            'id'
        );

        
        // Add comment.
        $this->addCommentOnTable($this->table, 'System Login user');
        $this->addCommentOnColumn($this->table, 'id', 'User id');
        $this->addCommentOnColumn($this->table, 'account', 'Login account');
        $this->addCommentOnColumn($this->table, 'password_encryption', 'Password encryption');
        $this->addCommentOnColumn($this->table, 'access_token', 'Access token');
        $this->addCommentOnColumn($this->table, 'auth_key', 'For cookie-based login');
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
        $this->dropTable('system_user_login');
    }
}
