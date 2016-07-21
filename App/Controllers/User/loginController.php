<?php

namespace App\Controllers\User;

use \Core\View;
use App\Models\User\LoginModel;

class LoginController extends \Core\Controller {

    public function index() {
        View::renderTemplate('User/login.php.twig');
    }

    public function login() {
        if (LoginModel::userExists($this->route_params)) {
            if (LoginModel::userActive($this->route_params)) {
                LoginModel::setSession($this->route_params);
                echo json_encode(['ok' => 1, 'msg' => '<b>Successful!</b>']);
            } else {
                echo json_encode(['ok' => 0, 'msg' => '<b>Account No Longer Active!</b>']);
            }
        } else {
            echo json_encode(['ok' => 0, 'msg' => '<b>Invalid Username or Password!</b>']);
        }
    }

}
