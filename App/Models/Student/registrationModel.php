<?php

namespace App\Models\Student;

use PDO;

class RegistrationModel extends \Core\Model {

    public static function register($params = []) {

        $db = static::getDB();

        $date = date('Y-m-d');
        $params['grade'] = strtoupper($params['grade']);
        $query = $db->prepare("INSERT INTO `scms`.`tblstudents` "
                . "(`Index`, `FirstName`, `LastName`, `Address`, `GuardianName`, `PhotoURL`, `GuardianContact`, `ContactNumber`, `Email`, `RegisteredDate`, `Grade`, `NameOfTheSchool`, `ReferenceInformation`, `OfficeAddress`, `MotherName`, `Occupation`) VALUES "
                . "(:index, :fname, :lname, :addr, :gname, :photo, :gcontact, :contact, :email, '{$date}', :grade, :schname, :ref, :offaddr, :mname, :ocp);");
        $count = $query->execute($params);
        if ($count === '1') {
            return true;
        }
        return false;
    }

    public static function get($index) {
        $db = static::getDB();

        $query = "SELECT * FROM tblstudents ORDER BY ID DESC";
        if ($index != 0) {
            $query = "SELECT
                    `Index` AS `index`, FirstName AS `fname`, LastName AS `lname`, Address AS `addr`, OfficeAddress AS `offaddr`, 
                    NameOfTheSchool AS `schname`, ReferenceInformation AS `ref`, Grade AS `grade`, GuardianName as `gname`, PhotoURL AS `photo`, 
                    GuardianContact AS `gcontact`, MotherName AS `mname`, Occupation AS `ocp`, ContactNumber AS `contact`, Email AS `email`
                    FROM `tblstudents`
                    WHERE
                    tblstudents.ID = '{$index}' LIMIT 1;";
            $handler = $db->query($query);

            $result = $handler->fetch(PDO::FETCH_ASSOC);

            return $result;
        } else {
            $handler = $db->query($query);

            $result = $handler->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
    }

    public static function getNextIndex($params = []) {
        $db = static::getDB();

        $prefix = "GCCA" . $params['year'] . strtoupper($params['grade']);
        $regex = "^" . $prefix;

        $query = $db->prepare("SELECT IF((COUNT(*)+1) < 10, (LPAD((COUNT(*)+1), 2, '0')), (COUNT(*))+1) as next FROM `tblstudents` WHERE `Index` REGEXP :regex LIMIT 1;");
        $query->execute(['regex' => $regex]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result && strlen($result['next']) > 0) {
            return $prefix . $result['next'];
        } else {
            return '';
        }
    }

    public static function update($params = []) {
        $db = static::getDB();
        $params['form']['grade'] = strtoupper($params['form']['grade']);
        $query = $db->prepare("UPDATE `scms`.`tblstudents` SET "
                . "`Index`= :index, `FirstName`= :fname, `LastName`= :lname, `Address`= :addr, `OfficeAddress`= :offaddr, `NameOfTheSchool`= :schname, `ReferenceInformation`= :ref, `Grade`= :grade, `GuardianName`= :gname, `PhotoURL`= :photo, `GuardianContact`= :gcontact, `MotherName`= :mname, `Occupation`= :ocp, `ContactNumber`= :contact, `Email`= :email WHERE (`ID`='{$params['id']}');");
        $count = $query->execute($params['form']);
        if ($count === '1') {
            return true;
        }
        return false;
    }

    public static function delete($params = []) {
        $db = static::getDB();

        $query = $db->prepare("DELETE FROM `tblstudents` WHERE (`ID`= :id)");
        $count = $query->execute($params);
        if ($count === '1') {
            return true;
        }
        return false;
    }

}
