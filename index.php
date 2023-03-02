<?php
    session_start();
    require('controller/controller.php');
    try {
        if(isset($_GET['page'])){
            if($_GET['page'] == 'home'){
                if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'Admin'){
                    if(isset($_POST['maj'])){
                        $id         = htmlspecialchars($_POST['maj']);
                        $title      = htmlspecialchars($_POST['title']);
                        $content    = htmlspecialchars($_POST['content']);
                        if(!empty($_POST['image'])){
                            $image  = setUpImageNews($_POST['image']);
                        }else{
                            $image  = 0;
                        }
                        if(isset($_POST['active'])){
                            $active = 1;
                        }else{
                            $active = 0;
                        }
                        majNews($id,$title,$content,$image,$active);
                    }
                    if(isset($_POST['new'])){
                        if(!empty($_POST['title']) && !empty($_POST['content']) && isset($_FILES['image'])){
                            $title      = htmlspecialchars($_POST['title']);
                            $content    = htmlspecialchars($_POST['content']);
                            $image      = setUpImageNews($_POST['image']);
                            if(isset($_POST['active'])){
                                $active = 1;
                            }else{
                                $active = 0;
                            }
                            addNews($title,$content,$image,$active);
                        }
                    }
                    homeAdmin();
                }else{home();}
            } 
            else if($_GET['page']=='restaurant'){restaurant();}
            else if($_GET['page']=='drinks'){drinks();}
            else if($_GET['page']=='wines'){wines();}
            else if($_GET['page']=='whiskies'){whiskies();}
            else if($_GET['page']=='rhums'){rhums();}
            else if($_GET['page']=='connection'){
                if(!empty($_POST['email']) && !empty($_POST['password'])){
                    $email      = htmlspecialchars($_POST['email']);
                    $password   = htmlspecialchars($_POST['password']);
                    connect($email,$password);
                }else if(isset($_GET['logout'])){
                    deconnect();
                }else{connection();}
            }
            else if($_GET['page']=='club'){
                if( !empty($_POST['pseudo']) &&
                    !empty($_POST['first_name']) &&
                    !empty($_POST['last_name']) &&
                    !empty($_POST['birthday']) &&
                    !empty($_POST['email']) &&
                    !empty($_POST['password']) &&
                    !empty($_POST['password_two'])){
                        $pseudo         = htmlspecialchars($_POST['pseudo']);
                        $first_name     = htmlspecialchars($_POST['first_name']);
                        $last_name      = htmlspecialchars($_POST['last_name']);
                        $birthday       = htmlspecialchars($_POST['birthday']);
                        $email          = htmlspecialchars($_POST['email']);
                        $password       = htmlspecialchars($_POST['password']);
                        $password_two   = htmlspecialchars($_POST['password_two']);
                        addNewUser( $pseudo,
                                    $first_name,
                                    $last_name,
                                    $birthday,
                                    $email,
                                    $password,
                                    $password_two);
                }else{club();}
            }
            else if($_GET['page']=='info'){info();}
            else if($_GET['page']=='recrut'){recrut();}
            else{throw new Exception("Cette page n'existe pas ou a été suprimée.");}
        }else{home();}
    }
    catch(Exception $e){
        // $error = $e->getMessage();
        // require('view/errorView.php');
        throw new Exception('Erreur : '.$e->getMessage());

    }