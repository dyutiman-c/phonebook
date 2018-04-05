<?php

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('users');

        $table->addColumn('name', 'text')
            ->addColumn('username', 'text')
            ->addColumn('password', 'text');

        $table->create();

        $table->insert(array(
            'name'      => 'Demo User',
            'username'  => 'demouser',
            'password'  => md5('xp857mou864')
        ));

        $table->saveData();
    }

    public function down()
    {
        $this->table('users')->drop();
    }
}
