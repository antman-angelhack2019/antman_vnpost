<?php

use App\View\AppView;
use Cake\ORM\ResultSet;

/**
 * @var AppView   $this
 * @var ResultSet $users
 */

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
//                'value'       => 'Laura',
                'class'       => 'form-control',
                'placeholder' => 'Enter your name',
                'name'        => 'from_name'
            ]) ?>
        </div>

        <div>
            <label class="form-label">Receive by:</label>
            <?= $this->Form->control('Receive by', [
                'label'       => false,
                'type'        => 'text',
//                'value'       => 'Sarah',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'to_name'
            ]) ?>
        </div>

        <div>
            <label class="form-label">Delivery from:</label>
            <?= $this->Form->control('Delivery from', [
                'label'       => false,
                'type'        => 'text',
//                'value'       => 'Ho Chi Minh',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'from_address'
            ]) ?>
        </div>

        <div>
            <label class="form-label">Delivery to:</label>
            <?= $this->Form->control('Delivery to', [
                'label'       => false,
                'type'        => 'text',
//                'value'       => 'Ha Noi',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'to_address'
            ]) ?>
        </div>

        <div>
            <label class="form-label">Sender telephone:</label>
            <?= $this->Form->control('Sender telephone', [
                'label'       => false,
                'type'        => 'text',
//                'value'       => '0988838948',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'from_tel'
            ]) ?>
        </div>

        <div>
            <label class="form-label">Receiver telephone:</label>
            <?= $this->Form->control('Receiver telephone', [
                'label'       => false,
                'type'        => 'text',
//                'value'       => '08739399595',
                'class'       => 'form-control',
                'placeholder' => 'Enter receiver name',
                'name'        => 'to_tel'
            ]) ?>
        </div>

        <div class="form-label">Product type:</div>
        <?= $this->Form->radio(
            'product_type',
            [ 'Basic', 'Important' ],
            [ 'value' => 0 ]
        ) ?>

        <label class="form-label">Product owner:</label>
        <?= $this->Form->select(
            'user_id', $users,
            [ 'class' => 'selectize-dropdown-content' ]
        ) ?>

        <label class="form-label">Location: </label>
        <?= $this->Form->select(
            'warehouse_id',
            [ 'Sai Gon', 'Hue', 'Da Lat' ],
            [ 'class' => 'selectize-dropdown-content' ]
        ) ?>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>
