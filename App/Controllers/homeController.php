<?php

namespace App\Controllers;

use \Core\View;

class HomeController extends \Core\Controller {

    protected function before() {
        if (!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
            header('location: login');
            return false;
        }
    }

    public function indexAction() {
        View::renderTemplate('home/index.php.twig');
    }

}
