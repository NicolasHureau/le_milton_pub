<?php
    class DbManager {
        protected function connection(){
            try{
                $db = new PDO('mysql:host=localhost;dbname=le_milton_pub;charset=utf8','root','');
            }
            catch(Exception $e){
                throw new Exception('Erreur : '.$e->getMessage());
            }
            return $db;
        }
    }