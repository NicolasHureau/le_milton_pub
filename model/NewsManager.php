<?php
    require_once('DbManager.php');
    class NewsManager extends DbManager {
        public function getCarouselNews(){
            $db = $this->connection();
            $requestCarousel = $db->query('SELECT * FROM news WHERE active = 1');
            return $requestCarousel;
        }
        public function getNews(){
            $db = $this->connection();
            $requestAdmin = $db->query('SELECT * FROM news');
            return $requestAdmin;
        }
        public function updateNews($id,$title,$content,$image,$active){
            $db = $this->connection();
            if(empty($image)){
                $requestUpdate = $db->prepare('UPDATE news SET title=:title,content=:content,active=:active WHERE ID=:id');
                $resultUpdate  = $requestUpdate->execute(['id'=>$id,'title'=>$title,'content'=>$content,'active'=>$active]);
            }else{
                $requestUpdate = $db->prepare('UPDATE news SET title=:title,content=:content,image=:image,active=:active WHERE ID=:id');
                $resultUpdate  = $requestUpdate->execute(['id'=>$id,'title'=>$title,'content'=>$content,'image'=>$image,'active'=>$active]);
            }
            return $resultUpdate;
        }
        public function addNews($title,$content,$image,$active){
            $db         = $this->connection();
            $request    = $db->prepare('INSERT INTO news(title,content,image,active) VALUES (?,?,?,?)');
            $resultNew  = $request->execute([$title,$content,$image,$active]);
            return $resultNew;
        }
    }