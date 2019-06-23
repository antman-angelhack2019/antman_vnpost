<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string $order_code
 * @property string $qr_code
 * @property string $rfid_code
 * @property string $bar_code
 * @property string $from_name
 * @property string $to_name
 * @property string $from_address
 * @property string $to_address
 * @property string $from_tel
 * @property string $to_tel
 * @property bool $product_type
 * @property int $user_id
 * @property int $warehouse_id
 * @property int $status
 * @property Admin $admin
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Warehouse $warehouse
 */
class Order extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'order_code' => true,
        'qr_code' => true,
        'rfid_code' => true,
        'bar_code' => true,
        'from_name' => true,
        'to_name' => true,
        'from_address' => true,
        'to_address' => true,
        'from_tel' => true,
        'to_tel' => true,
        'product_type' => true,
        'user_id' => true,
        'warehouse_id' => true,
        'status' => true,
        'user' => true,
        'warehouse' => true,
    ];
}
