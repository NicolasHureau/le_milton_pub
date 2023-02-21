<?php
    require_once('DbManager.php');
    class RestaurantManager extends DbManager {
        public function getDishes(){
            $db = $this->connection();
            $request = $db->query('SELECT * FROM restaurant');
            return $request;
        }
        // public function setDishes($type,$title,$content,$price){
        //     $db = $this->connection();
        //     $request = $db->prepare('INSERT INTO news(type,title,content,price) VALUES (?,?,?,?)');
        //     $result = $request->execute([$type,$title,$content,$price]);
        //     return $result;
        // }

    }