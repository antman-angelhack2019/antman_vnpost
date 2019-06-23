<?php


use Migrations\AbstractMigration;

class CreateUsersAndOrdersTable extends AbstractMigration {

    public function change() {
        $this->table('admins')
            ->addColumn('username', 'string', ['limit' => 128])
            ->addColumn('password', 'string')
            ->create();

        $this->table('orders')
            ->addColumn('from_name', 'string')
            ->addColumn('to_name', 'string')
            ->addColumn('from_address', 'string')
            ->addColumn('to_address', 'string')
            ->addColumn('from_tel', 'string', ['limit' => 64])
            ->addColumn('to_tel', 'string', ['limit' => 64])
            ->addColumn('type_product', 'boolean', ['null' => true, 'default' => 0])
            ->addColumn('user_id', 'integer')
            ->addColumn('status', 'boolean', ['null' => true, 'default' => 0, 'comment' => '0: unprocessed; 1: complete'])
            ->create();
    }
}
