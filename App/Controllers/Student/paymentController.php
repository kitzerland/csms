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
    
    public function payment(){
        echo json_encode(PaymentModel::payment($this->route_params['form']));
    }
    
    public function setCookie(){
        $rout_param = $this->route_params;
               
        setcookie('id', $rout_param['id']);
        setcookie('amount',  $rout_param['amount']);
        setcookie('comment', $rout_param['comment']);
  
        echo true;         
    }
    
    public function getCookie(){
        echo json_encode($_COOKIE);
    }
}
