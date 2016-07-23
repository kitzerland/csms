<?php

namespace App\Controllers\Student;

use \Core\View;
use App\Models\Student\PaymentModel;

class PaymentController extends \Core\Controller {

    protected function before() {
        if (!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
            header('location: login');
            return false;
        }
    }

    public function indexAction() {
        View::renderTemplate('Student/payment.php.twig');
    }
    
    public function payment(){
        echo json_encode(PaymentModel::payment($this->route_params['form']));
    }
}
