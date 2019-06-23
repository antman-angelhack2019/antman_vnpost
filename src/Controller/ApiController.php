<?php
namespace App\Controller;

use App\Model\Entity\Order;
use App\Model\Table\OrdersTable;
use Cake\Controller\Controller;
use Cake\Log\Log;
use Cake\Utility\Hash;


/**
 * @property OrdersTable Orders
 */
class ApiController extends Controller {

    public $inputs  = [];
    public $queries = [];
    public $params  = [];

    public function initialize() {
        parent::initialize();

        $this->loadModel('Orders');

        $this->queries = $this->request->getQueryParams();
        $this->params  = $this->request->getData();

        if(strpos($this->request->contentType(), 'application/json') !== false) {
            $this->inputs = $this->request->input('json_decode', true) ?? [];
        } else {
            $this->inputs = $this->request->getData();
        }
    }

    /**
     * @param array $data
     * @param int   $status
     */
    public function output(array $data = [], int $status = 200) {

        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function view(string $qr_code) {
        $order = $this->Orders->getByQrCode($qr_code);

        return $this->output([
            'order' => $order
        ]);
    }

    public function apiEdit(int $id) {
        $order = $this->Orders->get($id);

        $from_name    = $this->inputs['from_name'] ?? '';
        $to_name      = $this->inputs['to_name'] ?? '';
        $from_address = $this->inputs['from_address'] ?? '';
        $to_address   = $this->inputs['to_address'] ?? '';
        $from_tel     = $this->inputs['from_tel'] ?? '';
        $to_tel       = $this->inputs['to_tel'] ?? '';
        $product_type = intval($this->inputs['product_type'] ?? 0);

        if($product_type != 0 && $product_type != 1) {
            return $this->output([
                'error' => [
                    'code'    => 10,
                    'message' => 'Product type errors.'
                ]
            ]);
        }

        $order = $this->Orders->patchEntity($order, [
            'from_name'    => $from_name,
            'to_name'      => $to_name,
            'from_address' => $from_address,
            'to_address'   => $to_address,
            'from_tel'     => $from_tel,
            'to_tel'       => $to_tel,
            'product_type' => $product_type,
        ]);

        if(!$this->Orders->save($order)) {
            return $this->output([
                'error' => [
                    'code'    => 10,
                    'message' => 'Save data errors.'
                ]
            ]);
        }

        return $this->output([
            'order' => $order
        ]);
    }

    public function updateStatus() {
        $status   = intval($this->inputs['status'] ?? 0);
        $order_id = intval($this->inputs['order_id'] ?? 0);

        if(empty($order_id) || ($status != 1 && $status != 3)) {
            return $this->output([
                'error' => [
                    'code'    => 10,
                    'message' => 'Validation errors.'
                ]
            ]);
        }

        /* @var Order $order */
        $order = $this->Orders->get($order_id);
        $order = $this->Orders->patchEntity($order, ['status' => $status]);

        if(!$this->Orders->save($order)) {
            return $this->output([
                'error' => [
                    'code'    => 10,
                    'message' => 'Save data errors.'
                ]
            ]);
        }

        return $this->output([
            'order' => $order
        ]);
    }

    public function getList() {

        $orders = $this->Orders->getList();

        return $this->output([
            'order' => $orders
        ]);
    }

    public function updateStatusComplete() {
        $order_ids = $this->inputs['order_ids'] ?? [];

        if(empty($order_ids)) {
            return $this->output([
                'error' => [
                    'code'    => 10,
                    'message' => 'Order ids errors.'
                ]
            ]);
        }

        /* @var array $orders */
        $orders = $this->Orders->getByIds($order_ids);

        array_walk($orders, function(&$order) {
            return $order = $this->Orders->patchEntity($order, ['status' => 2]);
        });

        if(!$this->Orders->saveMany($orders)) {
            return $this->output([
                'error' => [
                    'code'    => 10,
                    'message' => 'Save data errors.'
                ]
            ]);
        }

        $orders = Hash::combine($orders, '{n}.id', '{*}');

        return $this->output([
            'order' => $orders
        ]);
    }
}
