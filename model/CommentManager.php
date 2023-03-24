<?php
    require_once('DbManager.php');
    class CommentManager extends DbManager{
        private $_userId;
        private $_alcoolId;
        private $_content;
        
        public function __construct(
            $comment_userId,
            $comment_alcoolId,
            $comment_content
        ){
            $this->setUserId($comment_userId);
            $this->setAlcoolId($comment_alcoolId);
            $this->setContent($comment_content);   
        }

        protected function getUserId()  {return $this->_userId;}
        protected function getAlcoolId(){return $this->_alcoolId;}
        protected function getContent() {return $this->_content;}

        protected function setUserId($comment_userId)       {$this->_userId     = $comment_userId;}
        protected function setAlcoolId($comment_alcoolId)   {$this->_alcoolId   = $comment_alcoolId;}
        protected function setContent($comment_content)     {$this->_content    = $comment_content;}

        public function addNewComment(){
            $db = $this->connection();
            $reqNewComment = $db->prepare('INSERT INTO comments(
                userId,
                alcoolId,
                content)
                VALUES(?,?,?)');
            $reqNewComment->execute([
                $this->getUserId(),
                $this->getAlcoolId(),
                $this->getContent()
            ]);
            // $this->CommentCount($cc);
        }

        // private function CommentCount($cc){
        //     $db = $this->connection();
        //     $reqCommentCount = $db->prepare('');

        // }

        public static function getAlcoolComments($alcoolId){
            $db = self::connection();
            $reqAlcoolComment = $db->prepare('SELECT * FROM comments WHERE alcool_id=?');
            $reqAlcoolComment->execute([$alcoolId]);
            return $reqAlcoolComment;
        }
        public static function getUserComments($userId){
            $db = self::connection();
            $reqUserComment = $db->prepare('SELECT * FROM comments WHERE user_id=?');
            $reqUserComment->execute([$userId]);
            return $reqUserComment;
        }

    }