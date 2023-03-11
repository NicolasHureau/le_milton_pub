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
                        if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){$image = setUpImage($_FILES['image'],$type = 'news');}else{$image;}
                        if(isset($_POST['active'])){$active = 1;}else{$active = 0;}
                        majNews($id,$title,$content,$image,$active);
                    }
                    if(isset($_POST['new'])){
                        if(!empty($_POST['title']) && !empty($_POST['content']) && (isset($_FILES['image']) && $_FILES['image']['error'] === 0)){
                            $title      = htmlspecialchars($_POST['title']);
                            $content    = htmlspecialchars($_POST['content']);
                            $image      = setUpImage($_FILES['image'],$type = 'news');
                            if(isset($_POST['active'])){$active = 1;}else{$active = 0;}
                            addNews($title,$content,$image,$active);
                        }
                    }
                    homeAdmin();
                }else{home();}
            } 
            else if($_GET['page'] == 'restaurant'){restaurant();}
            else if($_GET['page'] == 'drinks'){drinks();}
            else if($_GET['page'] == 'wine'){wines();}
            else if($_GET['page'] == 'alcool'){
                if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'Admin'){
                    if(isset($_POST['new'])){
                        if( !empty($_POST['name']) &&
                            !empty($_POST['degree']) &&
                            !empty($_POST['type']) &&
                            !empty($_POST['price2cl']) &&
                            !empty($_POST['price4cl'])){
                                $name       = htmlspecialchars($_POST['name']);
                                $degree     = htmlspecialchars($_POST['degree']);
                                $type       = htmlspecialchars($_POST['type']);
                                if(isset($_POST['category']))       {$category      = htmlspecialchars($_POST['category']);}else{$category;}
                                if(isset($_POST['origin']))         {$origin        = htmlspecialchars($_POST['origin']);}else{$origin;}
                                if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){$image = setUpImage($_FILES['image'],$_FILES['type']);}else{$image;}
                                if(isset($_POST['presentation']))   {$presentation  = htmlspecialchars($_POST['presentation']);}else{$presentation='';}
                                if(isset($_POST['degustation']))    {$degustation   = htmlspecialchars($_POST['degustation']);}else{$degustation='';}
                                $price2cl   = htmlspecialchars($_POST['price2cl']);
                                $price4cl   = htmlspecialchars($_POST['price4cl']);
                                if(isset($_POST['active']))         {$active = 1;}else{$active = 0;}
                                addNewAlcool(   $name,
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
                        }
                    }
                    if(isset($_POST['maj'])){
                        $id         = htmlspecialchars($_POST['maj']);
                        $name       = htmlspecialchars($_POST['name']);
                        $degree     = htmlspecialchars($_POST['degree']);
                        $type       = htmlspecialchars($_POST['type']);
                        if(isset($_POST['category']))       {$category      = htmlspecialchars($_POST['category']);}else{$category;}
                        if(isset($_POST['origin']))         {$origin        = htmlspecialchars($_POST['origin']);}else{$origin;}
                        if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){$image = setUpImage($_FILES['image'],$_POST['type']);}else{$image;}
                        if(isset($_POST['presentation']))   {$presentation  = htmlspecialchars($_POST['presentation']);}else{$presentation='';}
                        if(isset($_POST['degustation']))    {$degustation   = htmlspecialchars($_POST['degustation']);}else{$degustation='';}
                        $price2cl   = htmlspecialchars($_POST['price2cl']);
                        $price4cl   = htmlspecialchars($_POST['price4cl']);
                        if(isset($_POST['active'])){$active = 1;}else{$active = 0;}
                        var_dump($_FILES['image']['error']);
                        majAlcool(  $id,
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
                    }
                alcoolAdmin($_GET['type']);
                }else{alcool($_GET['type']);}
            }
            else if($_GET['page'] == 'connection'){
                if(!empty($_POST['email']) && !empty($_POST['password'])){
                    $email      = htmlspecialchars($_POST['email']);
                    $password   = htmlspecialchars($_POST['password']);
                    connect($email,$password);
                }else if(isset($_GET['logout'])){
                    deconnect();
                }else{connection();}
            }
            else if($_GET['page'] == 'club'){
                if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'Admin'){
                    clubAdmin();}
                else if(!empty($_POST['pseudo']) &&
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
            else if($_GET['page'] == 'info'){info();}
            else if($_GET['page'] == 'recrut'){
                if( !empty($_POST['first_name']) && 
                    !empty($_POST['last_name']) && 
                    !empty($_POST['birthday']) && 
                    !empty($_POST['secu']) && 
                    !empty($_POST['adress']) && 
                    !empty($_POST['zip_code']) && 
                    !empty($_POST['city']) && 
                    !empty($_POST['email']) && 
                    !empty($_POST['phone']) && 
                    !empty($_POST['job']) && 
                    !empty($_POST['motivation'])){
                        $first_name = htmlspecialchars($_POST['first_name']);
                        $last_name  = htmlspecialchars($_POST['last_name']);
                        $birthday   = htmlspecialchars($_POST['birthday']);
                        $secu       = htmlspecialchars($_POST['secu']);
                        $adress     = htmlspecialchars($_POST['adress']);
                        $zip_code   = htmlspecialchars($_POST['zip_code']);
                        $city       = htmlspecialchars($_POST['city']);
                        $email      = htmlspecialchars($_POST['email']);
                        $phone      = htmlspecialchars($_POST['phone']);
                        $job        = htmlspecialchars($_POST['job']);
                        $motivation = htmlspecialchars($_POST['motivation']);
                        sendEmailCandidacy( $first_name,
                                            $last_name,
                                            $birthday,
                                            $secu,
                                            $adress,
                                            $zip_code,
                                            $city,
                                            $email,
                                            $phone,
                                            $job,
                                            $motivation);
                }else{recrut();}
            }
            else{throw new Exception("Cette page n'existe pas ou a été suprimée.");}
        }else{home();}
    }
    catch(Exception $e){
        // $error = $e->getMessage();
        // require('view/errorView.php');
        throw new Exception('Erreur : '.$e->getMessage());

    }