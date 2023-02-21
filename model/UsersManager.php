<?php
    require_once('DbManager.php');
    class UsersManager extends DbManager {
        public function comparePseudo($pseudo){
            $db = $this->connection();
            $requestPseudo = $db->prepare('SELECT COUNT(*) as pseudoNumber FROM users WHERE pseudo = ?');
            $resultPseudo = $requestPseudo->execute([$pseudo]);
            while($pseudoVerif = $requestPseudo->fetch()){
                if($pseudoVerif['pseudoNumber'] != 0){
                    header('location: index.php?page=club&error=1&message=Votre Pseudo est déjà utilisé.');
                    exit();
                }
                return $resultPseudo;
            }
        }
        public function compareEmail($email){
            $db = $this->connection();
            $requestEmail = $db->prepare('SELECT COUNT(*) as emailNumber FROM users WHERE email = ?');
            $resultEmail = $requestEmail->execute([$email]);
            while($emailVerif = $requestEmail->fetch()){
                if($emailVerif['emailNumber'] != 0){
                    header('location: index.php?page=club&error=1&message=Votre adresse email est invalide.');
                    exit();
                }
                return $resultEmail;
            }
        }
        public function setUser($pseudo,$first_name,$last_name,$birthday,$email,$password){
            $db = $this->connection();
            $password = "m1lt0n".sha1($password."379")."pub";
            $secret = sha1($email).time();
            $secret = sha1($secret).time();
            $role = "customer";
            $requestUser = $db->prepare('INSERT INTO users(pseudo,first_name,last_name,birthday,email,password,secret,role) VALUES(?,?,?,?,?,?,?,?)');
            $result = $requestUser->execute([$pseudo,$first_name,$last_name,$birthday,$email,$password,$secret,$role]);
            return $result;
        }
    }