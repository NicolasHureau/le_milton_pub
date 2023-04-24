<?php
    require_once('DbManager.php');
    class SecurityManager extends DbManager{

        private static function passwordSame ($password,$password_two){
            if($password!==$password_two){
                header('location:index.php?page=club&error=1&message=Vos mots de passe ne sont pas identiques.');
                exit();
            }else{return true;}
        }
        private static function major($birthday){
            if((new \DateTime())->diff(new \DateTime($birthday))->format('%y') < 18){
                header('location: index.php?page=club&error=1&message=Vous devez être majeur pour vous inscrire.');
                exit();
            }else{return true;}
        }
        public static function emailSyntax($email){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header('location: index.php?page=club&error=1&message=Cette adresse email est invalide.');
                exit();
            }else{return true;}
        }
        private static function pseudoUnique($pseudo){
            $db = self::connection();
            $requestPseudo = $db->prepare('SELECT COUNT(*) as pseudoNumber FROM users WHERE pseudo = ?');
            $requestPseudo->execute([$pseudo]);
            while($pseudoVerif = $requestPseudo->fetch()){
                if($pseudoVerif['pseudoNumber'] != 0){
                    header('location: index.php?page=club&error=1&message=Ce Pseudo est déjà utilisé.');
                    exit();
                }else{return true;}
            }
        }
        private static function emailUnique($email){
            $db = self::connection();
            $requestEmail = $db->prepare('SELECT COUNT(*) as emailNumber FROM users WHERE email = ?');
            $requestEmail->execute([$email]);
            while($emailVerif = $requestEmail->fetch()){
                if($emailVerif['emailNumber'] != 0){
                    header('location: index.php?page=club&error=1&message=Cette adresse email est invalide.');
                    exit();
                }else{return true;}
            }
        }

        public static function setupImage($image,$type){
            if($image['size'] <= 3000000){
                $informationsImage = pathinfo($image['name']);
                $extensionImage    = $informationsImage['extension'];
                $extensionsArray   = ['png','gif','jpg','jpeg'];
                if(in_array($extensionImage,$extensionsArray)){
                    $newImageName = time().rand().'.'.$extensionImage;
                    move_uploaded_file($image['tmp_name'], 'public/assets/uploads/'.$type.'/'.$newImageName);
                }else{
                    header('location: index.php?page=home&error=1&message=Ne sont acceptée que les images \'png\', \'gif\', \'jpg\', \'jpeg\', choisissez-en une autre ou convertissez-la.');
                    exit();
                }
                return 'public/assets/uploads/'.$type.'/'.$newImageName;
            }else{
                header('location: index.php?page=home&error=1&message=Un problème est survenue avec l\'image.');
                exit();
            }     
        }

        public static function criptedPassword($password){
            return "m1lt0n".sha1($password."379")."pub";
        }
        public static function setSecret($email){
            $secret = sha1($email).time();
            $secret = sha1($secret).time();
            return $secret;
            // return sha1(sha1($email).time()).time(); ???
        }

        public static function checkDataNewUser($pseudo,
                                                $birthday,
                                                $email,
                                                $password,
                                                $password_two){
            if( self::passwordSame($password,$password_two) &&
                self::major($birthday) &&
                self::emailSyntax($email) &&
                self::pseudoUnique($pseudo) &&
                self::emailUnique($email)
            ){return true;}
        }
        public static function checkDataConnect($email,$password){
            $db = self::connection();
            $requestData = $db->prepare('SELECT * FROM users WHERE email = ?');
            $requestData->execute([$email]);
            $password = self::criptedPassword($password);
            while($user = $requestData->fetch()){
                if($password !== $user['password']){
                    header('location: index.php?page=connection&error=1&message=Impossible de vous authentifier correctement.');
                    exit();
                }else{return $user;}
            }
        }

        public static function seeDateFr($date){
            $date   = date_create($date);
            $dateFr = date_format($date,'d-m-Y');
            return $dateFr;
        }

    }