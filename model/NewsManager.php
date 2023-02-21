<?php
    require_once('DbManager.php');
    class NewsManager extends DbManager {
        public function getCarouselNews(){
            $db = $this->connection();
            $requestCarousel = $db->query('SELECT * FROM news');
            return $requestCarousel;
        }
        public function getNews(){
            $db = $this->connection();
            $requestAdmin = $db->query('SELECT * FROM news');
            return $requestAdmin;
        }
        public function setNews($title,$content,$image){
            $db = $this->connection();
            $request = $db->prepare('INSERT INTO news(title,content,image) VALUES (?,?,?)');
            $result = $request->execute([$title,$content,$image]);
            return $result;
        }
    }