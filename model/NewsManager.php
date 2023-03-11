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
        public function setUpImageNews($image){
            if($image['error'] === 0 && $image['size'] <= 3000000){
                $informationsImage = pathinfo($image['name']);
                $extensionImage    = $informationsImage['extension'];
                $extensionsArray   = ['png','gif','jpg','jpeg'];
                if(in_array($extensionImage,$extensionsArray)){
                    $newImageName = time().rand().'.'.$extensionImage;
                    move_uploaded_file($image['tmp_name'], 'public/assets/uploads/'.$newImageName);
                }else{
                    header('location: index.php?page=home&error=1&message=Ne sont acceptée que les images \'png\', \'gif\', \'jpg\', \'jpeg\', choisissez-en une autre ou convertissez-la.');
                    exit();
                }
                return 'public/assets/uploads/'.$newImageName;
            }else{
                header('location: index.php?page=home&error=1&message=Un problème est survenue avec l\'image.');
                exit();
            }     
        }
        public function majNews($id,$title,$content,$image,$active){
            $db = $this->connection();
            if(empty($image)){
                $requestMaj = $db->prepare('UPDATE news SET title=:title,content=:content,active=:active WHERE ID=:id');
                $resultMaj  = $requestMaj->execute(['id'=>$id,'title'=>$title,'content'=>$content,'active'=>$active]);
            }else{
                $requestMaj = $db->prepare('UPDATE news SET title=:title,content=:content,image=:image,active=:active WHERE ID=:id');
                $resultMaj  = $requestMaj->execute(['id'=>$id,'title'=>$title,'content'=>$content,'image'=>$image,'active'=>$active]);
            }
            return $resultMaj;
        }
        public function addNews($title,$content,$image,$active){
            $db         = $this->connection();
            $request    = $db->prepare('INSERT INTO news(title,content,image,active) VALUES (?,?,?,?)');
            $resultNew  = $request->execute([$title,$content,$image,$active]);
            return $resultNew;
        }
    }