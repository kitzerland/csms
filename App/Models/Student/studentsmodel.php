<?php

namespace App\Models\Student;

class StudentsModel extends \Core\Model {
    
    public $db;
    function __construct() {
        $db = static::getDB();
    }
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
    
    public static function get($index){
        $db = static::getDB();
        
        $query = "SELECT * FROM tblstudents";
        if($index != 0){
            $query .= " WHERE ID = '".$index."'";
        }
        
        $handler = $db->query($query);
        
        $result = $handler->fetchAll(\PDO::FETCH_ASSOC);
        
        return $result;
        
    }
   
}
