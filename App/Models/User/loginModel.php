<?php

namespace App\Models\User;

class LoginModel extends \Core\Model {

    public static function userExists($params = []) {
        $db = static::getDB();
        $query = $db->prepare("SELECT COUNT(*) AS count FROM `tblusers` WHERE `Username` = :username AND `Password` = :password LIMIT 1;");
        $query->execute($params);
        $count = $query->fetchColumn(0);
        if ($count === '1') {
            return true;
        }
        return false;
    }

    public static function userActive($params = []) {
        $db = static::getDB();
        $query = $db->prepare("SELECT IsActive FROM `tblusers` WHERE `Username` = :username AND `Password` = :password LIMIT 1;");
        $query->execute($params);
        $status = $query->fetchColumn(0);
        if ($status === '1') {
            return true;
        }
        return false;
    }

    public static function setSession($params) {
        $db = static::getDB();
        $query = $db->prepare("SELECT ID FROM `tblusers` WHERE `Username` = :username AND `Password` = :password LIMIT 1;");
        $query->execute($params);
        $userID = $query->fetchColumn(0);
        if (session_status() == PHP_SESSION_ACTIVE) {
            $_SESSION['userID'] = $userID;
            $_SESSION['name'] = $params['username'];
        }
    }

}
