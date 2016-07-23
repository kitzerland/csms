<?php

namespace App\Controllers\Student;

use \Core\View;
use App\Models\Student\StudentsModel;

class RegistrationController extends \Core\Controller {

    protected function before() {
        if (!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
            header('location: \login');
            return false;
        }
    }

    public function indexAction() {
        View::renderTemplate('Student/register.php.twig');
    }

    public function registerAction() {
        $status = StudentsModel::register($this->route_params['form']);
        echo json_encode($status);
    }
    
    public function getStudentAction(){
        
        $param = $this->route_params;
        $index = $param['index'];
        
        $result = StudentsModel::get($index);
        
        echo json_encode($result);
    }

}
