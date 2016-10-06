<?php

use yii\db\Migration;
use app\models\User;

/**
 * Handles the creation for table `user`.
 */
class m161004_173216_create_user_table extends Migration
{
    /**
     * @var string
     */
    private $table = 'user';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // Create table.
        $this->createTable($this->table, [
            'id' => $this->text(),
            'account' => $this->text()->notNull(),
            'password_encryption' => $this->text()->notNull(),
            'access_token' => $this->text(),
            'auth_key' => $this->text(),
            'data_status' => $this->integer(),
            'created_by' => $this->text(),
            'created_at' => $this->integer(),
            'updated_by' => $this->text(),
            'updated_at' => $this->integer(),
        ]);
        // Add comment.
        $this->addCommentOnTable($this->table, 'Login user');
        $this->addCommentOnColumn($this->table, 'id', 'User id');
        $this->addCommentOnColumn($this->table, 'account', 'Login account');
        $this->addCommentOnColumn($this->table, 'password_encryption', 'Password encryption');
        $this->addCommentOnColumn($this->table, 'access_token', 'Access token');
        $this->addCommentOnColumn($this->table, 'auth_key', 'For cookie-based login');
        $this->addCommentOnColumn($this->table, 'data_status', 'Data status');
        $this->addCommentOnColumn($this->table, 'created_by', 'Create user id');
        $this->addCommentOnColumn($this->table, 'created_at', 'Create timestamp');
        $this->addCommentOnColumn($this->table, 'updated_by', 'Update user id');
        $this->addCommentOnColumn($this->table, 'updated_at', 'Create timestamp');

        $this->createUserAdmin();
    }

    /**
     * Create the first user (account: admin, password: admin).
     */
    private function createUserAdmin()
    {
        $admin = new User(['account' => 'admin']);
        $admin->setPassword('admin');
        $admin->saveThrowError();
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
