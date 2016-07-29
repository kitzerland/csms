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
        
        if (empty($result['date'])) {
            $result['date'] = date('Y-m-d');
        }
        
        View::renderTemplate('Student/invoice.twig', $result);
    }

    public function paymentReportAction() {
        View::renderTemplate('Student/paymentHistory.php.twig');
    }

    public function paymentHistoryAction() {
        echo json_encode(PaymentModel::getHistory($this->route_params));
    }

    public function paymentOverdueAction() {
        View::renderTemplate('Student/paymentOverdue.php.twig');
    }

    public function overdueAction() {
        echo json_encode(PaymentModel::overdue($this->route_params));
    }

}
