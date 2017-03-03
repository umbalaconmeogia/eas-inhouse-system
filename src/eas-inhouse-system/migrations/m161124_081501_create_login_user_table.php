<?php

use app\models\LoginUser;
use batsg\migrations\BaseMigrationCreateTable;

/**
 * Handles the creation of table `login_user`.
 */
class m161124_081501_create_login_user_table extends BaseMigrationCreateTable
{
    protected $table = 'login_user';

    /**
     * {@inheritDoc}
     * @see \batsg\migrations\BaseMigrationCreateTable::createDbTable()
     */
    protected function createDbTable()
    {
        $this->createTableWithExtraFields($this->table, [
            'id' => $this->primaryKey(),
            'username' => [$this->string()->unique()->notNull(), 'ユーザーネーム'],
            'password_encryption' => [$this->text(), 'パスワード暗号化'],
            'access_token' => [$this->text(), 'クッキーキー'],
            'auth_key' => [$this->text(), '認証キー'],
            'must_change_password' => [$this->smallInteger(), 'パスワード要変更'],
        ]);

        $this->addComments($this->table, 'ユーザ');
    }

    /**
     * Create the first user (username: admin, password: admin).
     * {@inheritDoc}
     * @see \batsg\migrations\BaseMigrationCreateTable::initDbTable()
     */
    protected function initDbTable()
    {
        $admin = new LoginUser([
            'username' => 'admin',
        ]);
        $admin->setPassword('admin');
        $admin->saveThrowError();
    }
}
