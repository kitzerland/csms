<?php

namespace App\Controllers\Student;


use \Core\View;
use App\Models\Student\AchievementModel;

class AchievementController extends \Core\Controller {

    protected function before() {
        if (!isset($_SESSION['userID']) && empty($_SESSION['userID'])) {
            header('location: \login');
            return false;
        }
    }

    public function indexAction() {
        View::renderTemplate('Student/achievement.php.twig');
    }
                     
    public function achievementAction() {
        echo json_encode(AchievementModel::save($this->route_params['form']));
    }

}
