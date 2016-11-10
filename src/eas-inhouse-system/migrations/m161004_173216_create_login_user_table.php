<?php

use app\models\LoginUser;
use batsg\migrations\BaseMigration;

/**
 * Handles the creation for table `user`.
 */
class m161004_173216_create_login_user_table extends BaseMigration
{
    /**
     * @var string
     */
    private $table = 'login_user';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // Create table.
        $this->createTableWithExtraFields($this->table, [
            'username' => $this->text()->unique()->notNull(),
            'password_encryption' => $this->text()->notNull(),
            'access_token' => $this->text(),
            'auth_key' => $this->text(),
            'must_change_password' => $this->integer(),
        ]);
        // Add comment.
        $this->addComments($this->table, 'Login user', [
            'username' => 'Login username',
            'password_encryption' => 'Password encryption',
            'access_token' => 'Access token',
            'auth_key' => 'For cookie-based login',
            'must_change_password' => '1: Must change password when login',
        ]);

        $this->createUserAdmin();
    }

    /**
     * Create the first user (username: admin, password: admin).
     */
    private function createUserAdmin()
    {
        $admin = new LoginUser(['username' => 'admin']);
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
