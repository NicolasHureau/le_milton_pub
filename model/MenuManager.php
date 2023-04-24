<?php
    require_once('DbManager.php');
    class MenuManager extends DbManager{
        public function getPages($menu){
            $db = $this->connection();
            $requestPage = $db->prepare('SELECT * FROM '.$menu.' WHERE active=1');
            $requestPage->execute();
            return $requestPage;
        }
        public function getPagesAdmin($menu){
            $db = $this->connection();
            $requestPage = $db->prepare('SELECT * FROM '.$menu.' ');
            $requestPage->execute();
            return $requestPage;
        }
        public function updatePage($menu,$id,$image,$active){
            $db = $this->connection();
            if(empty($image)){
                $requestUpdate = $db->prepare('UPDATE '.$menu.' SET active=:active WHERE id=:id');
                $resultUpdate = $requestUpdate->execute(['id'=>$id,'active'=>$active]);
            }else{
                $requestUpdate = $db->prepare('UPDATE '.$menu.' SET image=:image,active=:active WHERE id=:id');
                $resultUpdate = $requestUpdate->execute(['id'=>$id,'image'=>$image,'active'=>$active]);
            }
            return $resultUpdate;
        }
        public function addPage($menu,$image,$active){
            $db = $this->connection();
            $request = $db->prepare('INSERT INTO '.$menu.'(image,active) VALUES (?,?)');
            $result = $request->execute([$image,$active]);
            return $result;
        }
    }