<?php

use Migrations\AbstractMigration;

class UpdateOrdersTableV2  extends AbstractMigration {

    public function change() {
        $this->table('orders')
            ->addColumn('rfid_code', 'string', ['null' => true, 'after' => 'order_code'])
            ->addColumn('bar_code', 'string', ['null' => true, 'after' => 'rfid_code'])
            ->addColumn('qr_code', 'string', ['null' => true, 'after' => 'bar_code'])
            ->addColumn('detail', 'json', ['null' => true, 'after' => 'qr_code'])
            ->update();
    }

}
