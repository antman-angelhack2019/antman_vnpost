<?php

use App\View\AppView;
use Cake\ORM\ResultSet;

/**
 * @var AppView   $this
 * @var ResultSet $order
 */
?>

<div class="card">
    <?php echo QRcode::svg($order[ 'qr_code' ], false, false, QR_ECLEVEL_Q, '23em'); ?>
</div>
