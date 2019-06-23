<?php

use App\View\AppView;
use Cake\ORM\ResultSet;
use App\Model\Entity\Order;

/**
 * @var AppView   $this
 * @var ResultSet $orders
 */

const LOCATION = [
    0 => 'Sai Gon',
    1 => 'Hue',
    2 => 'Da Lat'
];
const STATUS   = [
    0 => 'NEW',
    1 => 'APPROVED',
    2 => 'COMPLETE',
    3 => 'REJECT',
];
const HEADER   = [
    'Send by',
    'Receive by',
    'Delivery from',
    'Delivery to',
    'Sender tel',
    'Receiver tel',
    'Item owner',
    'Location',
    'Status',
]
?>

<div class="table-responsive">
    <table class="table card-table table-striped table-vcenter">
        <thead>
        <tr>
            <?php foreach ( HEADER as $header ): ?>
                <th><?= $header ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php if ( count($orders) === 0 ): ?>
            'Empty list'
        <?php endif; ?>

        <?php /** @var Order $order */
        foreach ( $orders as $order ): ?>
            <tr>
                <td><?= $order->from_name ?></td>
                <td><?= $order->to_name ?></td>
                <td><?= $order->from_address ?></td>
                <td><?= $order->to_address ?></td>
                <td><?= $order->to_tel ?></td>
                <td><?= $order->from_tel ?></td>
                <td><?= $order->admin->username ?? '-' ?></td>
                <td><?= LOCATION[ $order->warehouse_id ] ?></td>
                <td><?= STATUS[ $order->status ] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
