<?php

namespace App\Models\Student;

use PDO;

class SearchModel extends \Core\Model {

    public static function getResults($params = []) {
        if (!empty($params) && !empty($params['method']) && !empty($params['text'])) {
            $db = static::getDB();

            $method = $params['method'];
            $text = $params['text'];

            if ($method === 'id') {
                $query = $db->query("SELECT ID,FirstName,LastName,Address,GuardianName,ContactNumber,GuardianContact,Email FROM `tblstudents` WHERE ID LIKE '%{$text}%';");
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if ($method === 'name') {
                $query = $db->query("SELECT ID,FirstName,LastName,Address,GuardianName,ContactNumber,GuardianContact,Email FROM `tblstudents` WHERE FirstName LIKE '%{$text}%';");
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($result)) {
                    return $result;
                } else {
                    $query = $db->query("SELECT ID,FirstName,LastName,Address,GuardianName,ContactNumber,GuardianContact,Email FROM `tblstudents` WHERE LastName LIKE '%{$text}%';");
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }
            }
            return [];
        }
    }

    public static function getResultFor($params = []) {
        $db = static::getDB();
        
        $id = $params['id'];
        $query = $db->query("SELECT ID,FirstName,LastName,Address,GuardianName,ContactNumber,GuardianContact,Email FROM `tblstudents` WHERE ID = '{$id}' LIMIT 1;");
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

}
