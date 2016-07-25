<?php

namespace App\Controllers\Student;

use \Core\View;
use App\Models\Student\RegistrationModel;

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
        $status = RegistrationModel::register($this->route_params['form']);
        echo json_encode($status);
    }

    public function getStudentAction() {
        echo json_encode(RegistrationModel::get($this->route_params['index']));
    }

    public function nextIndexAction() {
        if (preg_match('/^20[0-9][0-9]$/', $this->route_params['year']) && preg_match('/^[a-zA-Z]{1}$/', $this->route_params['grade'])) {
            echo json_encode(RegistrationModel::getNextIndex($this->route_params));
        } else {
            echo json_encode('');
        }
    }

    public function updateAction() {
        echo json_encode(RegistrationModel::update($this->route_params));
    }

    public function deleteAction() {
        echo json_encode(RegistrationModel::delete($this->route_params));
    }

}
