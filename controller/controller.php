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
    function setupImage($image,$type){
        $image = SecurityManager::setupImage($image,$type);
        return $image;
    }
    function updateNews($id,$title,$content,$image,$active){
        $newsManager = new NewsManager();
        $resultUpdate = $newsManager->updateNews($id,$title,$content,$image,$active);
        if($resultUpdate){
            header('location: index.php?page=home&success=1&message=L\'actualié à bien été mise à jour.');
            exit(); 
        }
        else{
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
        }
        else{
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
    function alcool($type){
        $requestAlcool = AlcoolManager::getAlcool($type);
        require('view/alcoolView.php');
    }
    function alcoolAdmin($type){
        $requestAlcool = AlcoolManager::getAlcoolAdmin($type);
        require('view/alcoolView.php');
    }
    function addNewAlcool(
        $name,
        $degree,
        $type,
        $category,
        $origin,
        $image,
        $presentation,
        $degustation,
        $price2cl,
        $price4cl,
        $active){
            $alcoolManager = new AlcoolManager(
                $name,
                $degree,
                $type,
                $category,
                $origin,
                $image,
                $presentation,
                $degustation,
                $price2cl,
                $price4cl,
                $active);
            $result = $alcoolManager->addNewAlcool();
            if($result){
                header('location: index.php?page=alcool&type='.$type.'&success=1&message=Le produit à été ajouté.');
                exit();
            }
            else{
                header('locaction: index.php?page=alcool&type='.$type.'&error=1&message=Un problème est survenue.');
                exit();
            }

    }
    function updateAlcool(
        $id,
        $name,
        $degree,
        $type,
        $category,
        $origin,
        $image,
        $presentation,
        $degustation,
        $price2cl,
        $price4cl,
        $active){
            $resultUpdate = AlcoolManager::updateAlcool(
                $id,
                $name,
                $degree,
                $type,
                $category,
                $origin,
                $image,
                $presentation,
                $degustation,
                $price2cl,
                $price4cl,
                $active);
            if($resultUpdate){
                header('location: index.php?page=alcool&type='.$type.'&success=1&message=Le produit a été modifier.');
                exit();
            }
            else{
                header('locaction: index.php?page=alcool&type='.$type.'&error=1&message=Un problème est survenue.');
                exit();
            }
    }
    function connection(){require('view/connectionView.php');}
    function connect($email,$password){
        $user = SecurityManager::checkDataConnect($email,$password);
        $usersManager = new UsersManager(
            $user['pseudo'],
            $user['first_name'],
            $user['last_name'],
            $user['birthday'],
            $user['email'],
            $user['password'],
            $user['secret'],
            $user['role']);
        $usersManager->connect();
        header('location: index.php?page=connection');
        exit();
    }
    function deconnect(){
        session_destroy();
        session_unset();
        header('location: index.php?page=connection&logedout');
        exit();
    }
    function club(){require('view/clubView.php');}
    function addNewUser(
        $pseudo,
        $first_name,
        $last_name,
        $birthday,
        $email,
        $password,
        $password_two){
            if(SecurityManager::checkDataNewUser(
                $pseudo,
                $birthday,
                $email,
                $password,
                $password_two)){
                    $password       = SecurityManager::criptedPassword($password);
                    $secret         = SecurityManager::setSecret($email);
                    $role           = 'Customer';
                    $usersManager   = new UsersManager( 
                        $pseudo,
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
                        exit();
                    }
                    else{
                        header('location: index.php?page=club&error=1&message=Impossible de s\'inscrire pour l\'instant.');
                        exit();
                    }
            }
    }
    function updateUser(
        $id,
        $pseudo,
        $role,
        $first_name,
        $last_name,
        $birthday,
        $email,
        $ban){
            $resultUpdate = UsersManager::updateUser(
                $id,
                $pseudo,
                $role,
                $first_name,
                $last_name,
                $birthday,
                $email,
                $ban);
            if($resultUpdate){
                header('location: index.php?page=club&success=1&message=La fiche a été modifier.');
                exit();
            }
            else{
                header('locaction: index.php?page=club&error=1&message=Un problème est survenue.');
                exit();
            }
    }
    function clubAdmin(){
        $adminManager = new AdminManager();
        $requestAdmin = $adminManager->getUsers();
        require('view/clubView.php');
    }
    function info(){require('view/infoView.php');}
    function recrut(){require('view/recrutView.php');}
    function sendEmailCandidacy(
        $first_name,
        $last_name,
        $birthday,
        $secu,
        $adress,
        $zip_code,
        $city,
        $email,
        $phone,
        $job,
        $motivation){


                                };