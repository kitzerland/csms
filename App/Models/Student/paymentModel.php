<?php

namespace App\Models\Student;

use PDO;

class PaymentModel extends \Core\Model {

    public static function payment($params = []) {
        $db = static::getDB();

        $datetime = date("Y-m-d H:i:s");
        $query = $db->prepare("INSERT INTO `tblstudentpayment` "
                . "(`StudentID`, `Credit`, `Comment`, `Date`) VALUES "
                . "(:id, :amount, :comment, '{$datetime}');");
        $count = $query->execute($params);

        if ($count == "1") {
            return $db->lastInsertId();
        } else {
            return 0;
        }
    }

    public static function getStudent($params = []) {
        $db = static::getDB();
        $query = $db->prepare("SELECT FirstName AS fname, LastName AS lname FROM `tblstudents` WHERE tblstudents.ID = :id LIMIT 1;");
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

}
