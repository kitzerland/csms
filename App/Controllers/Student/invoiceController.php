<?php

namespace App\Controllers\Student;

use \Core\View;

class InvoiceController extends \Core\Controller {

    protected function before() {
        if (!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
            header('location: \login');
            return false;
        }
    }

    public function indexAction() {
        View::renderTemplate('Student/invoice.twig');
    }

}
