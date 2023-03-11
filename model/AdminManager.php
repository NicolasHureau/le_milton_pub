<?php
    require_once('DbManager.php');
    class AdminManager extends DbManager {
        public static function seeDateFr($date){
            $date   = date_create($date);
            $dateFr = date_format($date,'d-m-Y');
            return $dateFr;
        }
        public function getUsers(){
            $db = $this->connection();
            $requestAdmin = $db->query('SELECT * FROM users');
            return $requestAdmin;
        }
    }