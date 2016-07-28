<?php

namespace App\Models\Student;

use PDO;

class PaymentModel extends \Core\Model {

    public static function payment($params = []) {
        if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['userID']) && strlen($_SESSION['userID']) > 0) {
            $userID = $_SESSION['userID'];

            $db = static::getDB();

            $datetime = date("Y-m-d H:i:s");
            $query = $db->prepare("INSERT INTO `tblstudentpayment` "
                    . "(`StudentID`, `Credit`, `Comment`, `Date`, `PublisherID`) VALUES "
                    . "(:id, :amount, :comment, '{$datetime}', '{$userID}');");
            $count = $query->execute($params);

            if ($count == "1") {
                return $db->lastInsertId();
            } else {
                return 0;
            }
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

    public static function getHistory($params = []) {
        $db = static::getDB();

        $query = $db->prepare("SELECT tblstudentpayment.ID, tblstudentpayment.Credit AS amount, tblstudentpayment.`Comment` AS comment, DATE(`Date`) AS date "
                . "FROM `tblstudentpayment` "
                . "WHERE StudentID = :id "
                . "ORDER BY ID DESC;");
        $query->execute($params);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public static function overdue($params = []) {
        $db = static::getDB();
        if (!empty($params['month'])) {
            $arr = preg_split("/[-]/", $params['month']);
            if (sizeof($arr) > 1) {
                $year = $arr[0];
                $month = $arr[1];

                $query = "SELECT tblstudents.ID, tblstudents.`Index` AS `index`, tblstudents.FirstName AS fname, tblstudents.LastName AS lname, IFNULL(DATE(tblstudentpayment.Date), '') AS lpd "
                        . "FROM tblstudents "
                        . "LEFT JOIN tblstudentpayment ON tblstudents.ID = tblstudentpayment.StudentID "
                        . "WHERE tblstudents.ID NOT IN "
                        . "(SELECT StudentID FROM tblstudentpayment WHERE (YEAR(tblstudentpayment.Date) = '{$year}' AND MONTH(tblstudentpayment.Date) = '{$month}'));";
                $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    return $result;
                } else {
                    return [];
                }
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

}
