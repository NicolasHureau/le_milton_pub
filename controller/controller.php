<?php
    spl_autoload_register(function ($classe){
        require_once('model/'.$classe.'.php');
    });

    function home(){
        $newsManager = new NewsManager();
        $requestCarousel = $newsManager->getCarouselNews();
        $requestAdmin = $newsManager->getNews();
        require('view/home.php');
    }
    function addNews($title,$content,$image){
        $newsManager = new NewsManager();
        $result = $newsManager->setNews($title,$content,$image);
        if($result === false){
            throw new Exception("Impossible d'ajouter l'actualitée.");
        }
        else{
            header('location: index.php?page=home');
            exit();
        }
    }
    function restaurant(){
        // $restaurantManager = new RestaurantManager();
        // $request = $restaurantManager->getDishes();
        require('view/menuView.php');
    }
    function drinks(){
        // $drinksManager = new DrinksManager();
        // $request = $drinksManager->getDrinks();
        require('view/menuView.php');
    }
    function wines(){
        // $winesManager = new WinesManager();
        // $request = $winesManager->getWines();
        require('view/menuView.php');
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
        header('location: index.php?page=connection&success=1');
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