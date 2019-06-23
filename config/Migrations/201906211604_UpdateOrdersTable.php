<?php

use Migrations\AbstractMigration;

class UpdateOrdersTable extends AbstractMigration {

    public function change() {
        $this->table('orders')
            ->addColumn('order_code', 'string', ['limit' => 16, 'after' => 'id'])
            ->renameColumn('type_product', 'product_type')
            ->addColumn('warehouse_id', 'integer', ['default' => 0, 'comment' => '0: HCM; 1: HN', 'after' => 'user_id'])
            ->changeColumn('status', 'integer', ['limit' => 4, 'default' => 0, 'comment' => '0: new; 1: approved; 2: complete; 3: reject'])
            ->update();

        $this->table('orders')
            ->changeColumn('product_type', 'boolean', ['default' => 0])
            ->update();
    }

}
