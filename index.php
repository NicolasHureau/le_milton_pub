<?php
    require('controller/controller.php');
    try {
        if(isset($_GET['page'])){
            if($_GET['page']=='home'){
                if(!empty($_POST['title']) && !empty($_POST['content']) && isset($_FILES['image'])){
                    if($_FILES['image']['error']===0 && $_FILES['image']['size']<=3000000){
                        $informationsImage = pathinfo($_FILES['image']['name']);
                        $extensionImage    = $informationsImage['extension'];
                        $extensionsArray   = ['png', 'gif', 'jpg', 'jpeg'];
                        if(in_array($extensionImage, $extensionsArray)) {
                            $newImageName = time().rand().'.'.$extensionImage;
                            move_uploaded_file($_FILES['image']['tmp_name'], 'public/assets/uploads/'.$newImageName);
                            addNews(htmlspecialchars($_POST['title']),htmlspecialchars($_POST['content']),'public/assets/uploads/'.$newImageName);
                            home();    
                        }
                    }
                }else{home();}
            } 
            else if($_GET['page']=='restaurant'){restaurant();}
            else if($_GET['page']=='drinks'){drinks();}
            else if($_GET['page']=='wines'){drinks();}
            else if($_GET['page']=='whiskies'){drinks();}
            else if($_GET['page']=='rhums'){drinks();}
            else if($_GET['page']=='connection'){connection();}
            else if($_GET['page']=='club'){
                if(!empty($_POST['pseudo']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['birthday']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_two'])){
                    $pseudo         =htmlspecialchars($_POST['pseudo']);
                    $first_name     =htmlspecialchars($_POST['first_name']);
                    $last_name      =htmlspecialchars($_POST['last_name']);
                    $birthday       =htmlspecialchars($_POST['birthday']);
                    $email          =htmlspecialchars($_POST['email']);
                    $password       =htmlspecialchars($_POST['password']);
                    $password_two   =htmlspecialchars($_POST['password_two']);
                    if($password!==$password_two){
                        header('location:index.php?page=club&error=1&message=Vos mots de passe ne sont pas identiques.');
                        exit();
                    }
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        header('location: index.php?page=club&error=1&message=Votre adresse email est invalide.');
                        exit();
                    }
                    if((new \DateTime())->diff(new \DateTime($_POST['birthday']))->format('%y') < 18){
                        header('location: index.php?page=club&error=1&message=Vous devez être majeur pour vous inscrire.');
                        exit();
                    }
                    addUser($pseudo,$first_name,$last_name,$birthday,$email,$password);
                }else{club();}
            }
            else if($_GET['page']=='info'){info();}
            else if($_GET['page']=='recrut'){recrut();}
            else{throw new Exception("Cette page n'existe pas ou a été suprimée.");}

        }else{home();}

    }
    catch(Exception $e) {
        // $error = $e->getMessage();
        // require('view/errorView.php');
        throw new Exception('Erreur : '.$e->getMessage());

    }