<?php

namespace App\Models\Student;

use PDO;

class PaymentModel extends \Core\Model {

    public static function payment($params = []) {
        if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['userID']) && strlen($_SESSION['userID']) > 0) {
            $userID = $_SESSION['userID'];

            $db = static::getDB();

            $diffQ = "SELECT TIMESTAMPDIFF(MONTH, tblstudentpayment.PaymentMonth, '{$params['paymentMonth']}') AS diff "
                    . "FROM `tblstudentpayment`"
                    . "WHERE "
                    . "tblstudentpayment.StudentID = '{$params["id"]}' "
                    . "ORDER BY tblstudentpayment.ID DESC LIMIT 1";
            $diffR = $db->query($diffQ)->fetchAll(PDO::FETCH_ASSOC);

            if (empty($diffR) || (!empty($diffR[0]["diff"]) && $diffR[0]["diff"] == 1)) {

                $datetime = date("Y-m-d H:i:s");
                $query = $db->prepare("INSERT INTO `tblstudentpayment` "
                        . "(`StudentID`, `Credit`, `Comment`, `PaymentMonth`, `Date`, `PublisherID`) VALUES "
                        . "(:id, :amount, :comment, :paymentMonth,'{$datetime}', '{$userID}');");
                $count = $query->execute($params);

                if ($count == "1") {
                    return $db->lastInsertId();
                } else {
                    return 0;
                }
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

        $query = $db->prepare("SELECT tblstudentpayment.ID, tblstudentpayment.Credit AS amount, tblstudentpayment.`Comment` AS comment, tblstudentpayment.`PaymentMonth` AS pm, DATE(`Date`) AS date "
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

//                $query = "SELECT tblstudents.ID, tblstudents.`Index` AS `index`, tblstudents.FirstName AS fname, tblstudents.LastName AS lname, IFNULL(DATE(tblstudentpayment.Date), '') AS lpd, IFNULL(DATE(tblstudentpayment.PaymentMonth), '') AS lpm "
//                        . "FROM "
//                        . "tblstudents "
//                        . "LEFT JOIN tblstudentpayment ON tblstudentpayment.StudentID = tblstudents.ID "
//                        . "WHERE tblstudents.ID NOT IN (SELECT tblstudentpayment.StudentID FROM tblstudentpayment "
//                        . "WHERE YEAR(tblstudentpayment.`PaymentMonth`) = '{$year}' AND MONTH(tblstudentpayment.`PaymentMonth`) = '{$month}');";

                $query = "SELECT\n" .
                        "tblstudents.ID,\n" .
                        "tblstudents.`Index` AS `index`,\n" .
                        "tblstudents.FirstName AS fname,\n" .
                        "tblstudents.LastName AS lname,\n" .
                        "IFNULL((SELECT tblstudentpayment.`ID` FROM tblstudentpayment WHERE tblstudentpayment.StudentID = tblstudents.ID ORDER BY tblstudentpayment.ID DESC LIMIT 1), '') as paymentID,\n" .
                        "IFNULL((SELECT DATE(tblstudentpayment.`Date`) FROM tblstudentpayment WHERE tblstudentpayment.StudentID = tblstudents.ID ORDER BY tblstudentpayment.ID DESC LIMIT 1), '') as lpd,\n" .
                        "IFNULL((SELECT DATE(tblstudentpayment.PaymentMonth) FROM tblstudentpayment WHERE tblstudentpayment.StudentID = tblstudents.ID ORDER BY tblstudentpayment.ID DESC LIMIT 1), '') as lpm\n" .
                        "FROM\n" .
                        "tblstudents\n" .
                        "LEFT JOIN tblstudentpayment ON tblstudentpayment.StudentID = tblstudents.ID\n" .
                        "WHERE tblstudents.ID NOT IN (SELECT\n" .
                        "tblstudentpayment.StudentID\n" .
                        "FROM\n" .
                        "tblstudentpayment\n" .
                        "WHERE YEAR(tblstudentpayment.PaymentMonth) = '{$year}' AND MONTH(tblstudentpayment.PaymentMonth) = '{$month}')\n" .
                        "GROUP BY tblstudents.ID";

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
