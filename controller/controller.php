<?php
    require('model/NewsManager.php');
    require('model/RestaurantManager.php');
    require('model/DrinksManager.php');
    require('model/UsersManager.php');
    require('model/NotesManager.php');

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
    function connection(){

        require('view/connectionView.php');
    }
    function club(){
        require('view/clubView.php');
    }
    function addUser($pseudo,$first_name,$last_name,$birthday,$email,$password){
        $usersManager = new UsersManager();
        $checkPseudo = $usersManager->comparePseudo($pseudo);
        $checkEmail = $usersManager->compareEmail($email);
        if($checkPseudo && $checkEmail){
            $result = $usersManager->setUser($pseudo,$first_name,$last_name,$birthday,$email,$password);
            if($result === false){
                throw new Exception("Impossible d'ajouter un nouvel utilisateur pour le moment.");
            }
            else{
                header('location: index.php?page=club&success=1');
                
                exit();
            }
        }
    }
    function info(){
        require('view/infoView.php');
    }
    function recrut(){
        require('view/recrutView.php');
    }