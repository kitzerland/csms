<?php

namespace App\Models\Student;

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

}
