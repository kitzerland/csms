<?php

namespace App\Controllers\Student;

use \Core\View;
use App\Models\Student\PaymentModel;

class PaymentController extends \Core\Controller {

    protected function before() {
        if (!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
            header('location: \login');
            return false;
        }
    }

    public function indexAction() {
        View::renderTemplate('Student/payment.php.twig');
    }

    public function paymentAction() {
        echo json_encode(PaymentModel::payment($this->route_params['form']));
    }

    public function invoiceAction() {
        $result = PaymentModel::getStudent(['id' => $this->route_params['id']]);
        $result = array_merge($result, $this->route_params);
        View::renderTemplate('Student/invoice.twig', $result);
    }

}
