<?php

namespace App\Controllers\Student;

use App\Models\Student\SearchModel;

class SearchController extends \Core\Controller {

    protected function before() {
        if (!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
            header('location: \login');
            return false;
        }
    }

    public function indexAction() {
        echo json_encode(SearchModel::getResults($this->route_params));
    }

    public function getResult() {
        echo json_encode(SearchModel::getResultFor($this->route_params));
    }

}
