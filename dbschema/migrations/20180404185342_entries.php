<?php


use Phinx\Migration\AbstractMigration;

class Entries extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('entries');

        $table->addColumn('name', 'text')
            ->addColumn('phone', 'text')
            ->addColumn('note', 'text')
            ->addColumn('created_at', 'datetime');

        $table->create();

    }

    public function down()
    {
        $this->table('entries')->drop();
    }
}
