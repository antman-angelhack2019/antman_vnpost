<?php

use App\View\AppView;
use Cake\ORM\ResultSet;
use App\Model\Entity\Order;

/**
 * @var AppView   $this
 * @var ResultSet $users
 * @var Order     $order
 */
const STATUS   = [
    0 => 'NEW',
    1 => 'APPROVED',
    2 => 'COMPLETE',
    3 => 'REJECT',
];
?>

<?= $this->Form->create('deliverForm') ?>

<div class="card">
    <div class="card-body p-6">
        <div class="card-title">Please enter your delivery information</div>
        <div class="form-group">
            <label class="form-label">Send by:</label>
            <?= $this->Form->control('Send by', [
                'label'       => false,
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Enter your name',
                'name'        => 'from_name',
                'value'       => $order->from_name
            ]) ?>
        </div>

        <div>
            <label class="form-label">Receive by:</label>
            <?= $this->Form->control('Receive by', [
                'label'       => false,
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'to_name',
                'value'       => $order->to_name
            ]) ?>
        </div>

        <div>
            <label class="form-label">Delivery from:</label>
            <?= $this->Form->control('Delivery from', [
                'label'       => false,
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'from_address',
                'value'       => $order->from_address
            ]) ?>
        </div>

        <div>
            <label class="form-label">Delivery to:</label>
            <?= $this->Form->control('Delivery to', [
                'label'       => false,
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'to_address',
                'value'       => $order->to_address
            ]) ?>
        </div>

        <div>
            <label class="form-label">Sender telephone:</label>
            <?= $this->Form->control('Sender telephone', [
                'label'       => false,
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'from_tel',
                'value'       => $order->from_tel
            ]) ?>
        </div>

        <div>
            <label class="form-label">Receiver telephone:</label>
            <?= $this->Form->control('Receiver telephone', [
                'label'       => false,
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'to_tel',
                'value'       => $order->to_tel
            ]) ?>
        </div>

        <div class="form-label">Product type:</div>
        <?= $this->Form->radio(
            'product_type',
            [ 'Basic', 'Important' ],
            [ 'value' => $order->product_type ?? 0 ]
        ) ?>

        <label class="form-label">Product owner:</label>
        <?= $this->Form->select(
            'user_id', $users,
            [ 'class' => 'selectize-dropdown-content', 'value' => $order->admin->id ]
        ) ?>

        <label class="form-label">Location: </label>
        <?= $this->Form->select(
            'warehouse_id',
            [ 'Sai Gon', 'Hue', 'Da Lat' ],
            [ 'class' => 'selectize-dropdown-content', 'value' => $order->warehouse_id ]
        ) ?>

        <div class="form-label">Change status:</div>
        <?= $this->Form->radio(
            'status', STATUS,
            [ 'value' => $order->status ]
        ) ?>

        <div class="form-footer" style="text-align: center;">
            <button type="submit" class="btn btn-azure ml-auto">Update</button>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>
