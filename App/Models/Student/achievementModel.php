<?php

namespace App\Models\Student;

class AchievementModel extends \Core\Model {

    public static function save($params = []) {
        if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['userID']) && strlen($_SESSION['userID']) > 0) {
            $userID = $_SESSION['userID'];
            $db = static::getDB();

            $date = date("Y-m-d");
            $query = $db->prepare("INSERT INTO `tblstudentachievement` "
                    . "(`StudentID`, `Name`, `Description`, `ImageURL`, `AchievmentDate`, `CreatedDate`, `PublisherID`) VALUES "
                    . "(:id, :name, :description, :photo, :date, '{$date}', '{$userID}');");
            $count = $query->execute($params);
            if ($count == "1") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
