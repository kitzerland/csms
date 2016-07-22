<?php

namespace App\Models\Student;

class RegistrationModel extends \Core\Model {

    public static function register($params = []) {
        $db = static::getDB();
        $date = date('Y-m-d');
        $query = $db->prepare("INSERT INTO `scms`.`tblstudents` "
                . "(`FirstName`, `LastName`, `Address`, `GuardianName`, `PhotoURL`, `GuardianContact`, `ContactNumber`, `Email`, `RegisteredDate`) VALUES "
                . "(:fname, :lname, :addr, :gname, :photo, :gcontact, :contact, :email, '{$date}');");
        $count = $query->execute($params);
        if ($count === '1') {
            return true;
        }
        return false;
    }

}
