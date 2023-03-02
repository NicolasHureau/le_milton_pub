<?php
    spl_autoload_register(function ($classe){
        require_once('model/'.$classe.'.php');
    });

    function home(){
        $newsManager = new NewsManager();
        $requestCarousel = $newsManager->getCarouselNews();
        require('view/home.php');
    }
    function homeAdmin(){
        $newsManager = new NewsManager();
        $requestAdmin = $newsManager->getNews();
        require('view/home.php');
    }
    function setUpImageNews($image){
        $newsManager = new NewsManager();
        $newsManager->setUpImageNews($image);
    }
    function majNews($id,$title,$content,$image,$active){
        $newsManager = new NewsManager();
        $resultMaj = $newsManager->majNews($id,$title,$content,$image,$active);
        if($resultMaj){
            header('location: index.php?page=home&success=1&message=L\'actualié à bien été mise à jour.');
            exit(); 
        }else{
            header('location: index.php?page=home&error=1&message=Un problème est survenue.');
            exit();
        }
    }
    function addNews($title,$content,$image,$active){
        $newsManager = new NewsManager();
        $resultNew = $newsManager->addNews($title,$content,$image,$active);
        if($resultNew){
            header('location: index.php?page=home&success=1&message=L\'actualié à bien été ajoutée.');
            exit(); 
        }else{
            header('location: index.php?page=home&error=1&message=Un problème est survenue.');
            exit();
        }
    }
    function restaurant(){
        // $restaurantManager = new RestaurantManager();
        // $request = $restaurantManager->getDishes();
        require('view/restaurantView.php');
    }
    function drinks(){
        // $drinksManager = new DrinksManager();
        // $request = $drinksManager->getDrinks();
        require('view/restaurantView.php');
    }
    function wines(){
        // $winesManager = new WinesManager();
        // $request = $winesManager->getWines();
        require('view/restaurantView.php');
    }
    function whiskies(){
        // $whiskiesManager = new WhiskiesManager();
        // $request = $whiskiesManager->getWhiskies();
        require('view/alcoolView.php');
    }
    function rhums(){
        // $rhumsManager = new RhumsManager();
        // $request = $rhumsManager->getRhums();
        require('view/alcoolView.php');
    }
    function connection(){require('view/connectionView.php');}
    function connect($email,$password){
        $user = SecurityManager::checkDataConnect($email,$password);
        $usersManager = new UsersManager(   $user['pseudo'],
                                            $user['first_name'],
                                            $user['last_name'],
                                            $user['birthday'],
                                            $user['email'],
                                            $user['password'],
                                            $user['secret'],
                                            $user['role']);
        $usersManager->connect();
        header('location: index.php?page=connection');
    }
    function deconnect(){
        session_destroy();
        session_unset();
        header('location: index.php?page=connection&logedout');
    }
    function club(){require('view/clubView.php');}
    function addNewUser($pseudo,
                        $first_name,
                        $last_name,
                        $birthday,
                        $email,
                        $password,
                        $password_two){
        if(SecurityManager::checkDataNewUser(   $pseudo,
                                                $birthday,
                                                $email,
                                                $password,
                                                $password_two)){
            $password       = SecurityManager::criptedPassword($password);
            $secret         = SecurityManager::setSecret($email);
            $role           = 'Customer';
            $usersManager   = new UsersManager( $pseudo,
                                                $first_name,
                                                $last_name,
                                                $birthday,
                                                $email,
                                                $password,
                                                $secret,
                                                $role);
            $result         = $usersManager->addNewUser();
            if($result){
                $usersManager->connect();
                header('location: index.php?page=connection&success=1');
            }else{
                header('location: index.php?page=club&error=1&message=Impossible de s\'inscrire pour l\'instant.');
                exit();
            }
        }
    }
    function info(){require('view/infoView.php');}
    function recrut(){require('view/recrutView.php');}