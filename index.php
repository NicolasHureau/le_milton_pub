<?php
    session_start();
    require('controller/controller.php');
    try {
        if(isset($_GET['page'])){
            if($_GET['page'] == 'home'){
                if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'admin'){
                    if(isset($_POST['update'])){
                        $id         = htmlspecialchars($_POST['update']);
                        $title      = htmlspecialchars($_POST['title']);
                        $content    = htmlspecialchars($_POST['content']);
                        if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){$image = setupImage($_FILES['image'],$type = 'news');}else{$image;}
                        if(isset($_POST['active'])){$active = 1;}else{$active = 0;}
                        updateNews($id,$title,$content,$image,$active);
                    }
                    else if(isset($_POST['new'])){
                        if(!empty($_POST['title']) && !empty($_POST['content']) && (isset($_FILES['image']) && $_FILES['image']['error'] === 0)){
                            $title      = htmlspecialchars($_POST['title']);
                            $content    = htmlspecialchars($_POST['content']);
                            $image      = setupImage($_FILES['image'],$type = 'news');
                            if(isset($_POST['active'])){$active = 1;}else{$active = 0;}
                            addNews($title,$content,$image,$active);
                        }
                    }
                    else{homeAdmin();}
                }
                else{home();}
            } 
            else if($_GET['page'] == 'restaurant' || $_GET['page'] == 'drinks' || $_GET['page'] == 'wine'){
                $menu = $_GET['page'];
                if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'admin'){
                    if(isset($_POST['new']) && !empty($_FILES)){
                        $image = setupImage($_FILES['image'],$type = $menu);
                        if(isset($_POST['active'])){$active = 1;}else{$active = 0;}
                        addPage($menu,$image,$active);
                    }
                    else if(isset($_POST['update'])){
                        $id = htmlspecialchars($_POST['update']);
                        if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){$image = setupImage($_FILES['image'],$type = $menu);}else{$image;}
                        if(isset($_POST['active'])){$active = 1;}else{$active = 0;}
                        updatePage($menu,$id,$image,$active);
                    }
                    else{menuAdmin($menu);}
                }
                else{menu($menu);}
            }
            else if($_GET['page'] == 'alcool'){
                if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'admin'){
                    if(isset($_POST['new'])){
                        if( !empty($_POST['name']) &&
                            !empty($_POST['degree']) &&
                            !empty($_POST['type']) &&
                            !empty($_POST['price4cl'])){
                                $name       = htmlspecialchars($_POST['name']);
                                $degree     = htmlspecialchars($_POST['degree']);
                                $type       = htmlspecialchars($_POST['type']);
                                if(isset($_POST['category']))       {$category      = htmlspecialchars($_POST['category']);}else{$category;}
                                if(isset($_POST['origin']))         {$origin        = htmlspecialchars($_POST['origin']);}else{$origin;}
                                if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){$image = setupImage($_FILES['image'],$_POST['type']);}else{$image;}
                                if(isset($_POST['presentation']))   {$presentation  = htmlspecialchars($_POST['presentation']);}else{$presentation='';}
                                if(isset($_POST['degustation']))    {$degustation   = htmlspecialchars($_POST['degustation']);}else{$degustation='';}
                                $price2cl   = htmlspecialchars($_POST['price2cl']);
                                $price4cl   = htmlspecialchars($_POST['price4cl']);
                                if(isset($_POST['active']))         {$active = 1;}else{$active = 0;}
                                addNewAlcool(
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
                    }
                    else if(isset($_POST['update'])){
                        $id         = htmlspecialchars($_POST['update']);
                        $name       = htmlspecialchars($_POST['name']);
                        $degree     = htmlspecialchars($_POST['degree']);
                        $type       = htmlspecialchars($_POST['type']);
                        if(isset($_POST['category']))       {$category      = htmlspecialchars($_POST['category']);}else{$category;}
                        if(isset($_POST['origin']))         {$origin        = htmlspecialchars($_POST['origin']);}else{$origin;}
                        if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){$image = setupImage($_FILES['image'],$_POST['type']);}else{$image;}
                        if(isset($_POST['presentation']))   {$presentation  = htmlspecialchars($_POST['presentation']);}else{$presentation='';}
                        if(isset($_POST['degustation']))    {$degustation   = htmlspecialchars($_POST['degustation']);}else{$degustation='';}
                        $price2cl   = htmlspecialchars($_POST['price2cl']);
                        $price4cl   = htmlspecialchars($_POST['price4cl']);
                        if(isset($_POST['active'])){$active = 1;}else{$active = 0;}
                        updateAlcool(
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
                    }
                    else{alcoolAdmin($_GET['type']);}
                }
                else{alcool($_GET['type']);}
            }
            else if($_GET['page'] == 'connection'){
                if(!empty($_POST['email']) && !empty($_POST['password'])){
                    $email      = htmlspecialchars($_POST['email']);
                    $password   = htmlspecialchars($_POST['password']);
                    connect($email,$password);
                }
                else if(isset($_GET['logout'])){
                    deconnect();
                }
                else{connection();}
            }
            else if($_GET['page'] == 'club'){
                if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'admin'){
                    if(isset($_POST['update'])){
                        $id             = htmlspecialchars($_POST['update']);
                        $pseudo         = htmlspecialchars($_POST['pseudo']);
                        $role           = htmlspecialchars($_POST['role']);
                        $first_name     = htmlspecialchars($_POST['first_name']);
                        $last_name      = htmlspecialchars($_POST['last_name']);
                        $birthday       = htmlspecialchars($_POST['birthday']);
                        $email          = htmlspecialchars($_POST['email']);
                        if(isset($_POST['ban'])){$ban = 1;}else{$ban = 0;}
                        updateUser(
                            $id,
                            $pseudo,
                            $role,
                            $first_name,
                            $last_name,
                            $birthday,
                            $email,
                            $ban);
                    }
                    else{clubAdmin();}
                }
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
                            addNewUser(
                                $pseudo,
                                $first_name,
                                $last_name,
                                $birthday,
                                $email,
                                $password,
                                $password_two);
                }
                else{club();}
            }
            else if($_GET['page'] == 'info'){info();}
            else if($_GET['page'] == 'recrut'){
                if( !empty($_POST['first_name']) && 
                    !empty($_POST['last_name']) && 
                    !empty($_POST['birthday']) && 
                    !empty($_POST['adress']) && 
                    !empty($_POST['zip_code']) && 
                    !empty($_POST['city']) && 
                    !empty($_POST['email']) && 
                    !empty($_POST['phone'])){
                        $first_name = htmlspecialchars($_POST['first_name']);
                        $last_name  = htmlspecialchars($_POST['last_name']);
                        $birthday   = htmlspecialchars($_POST['birthday']);
                        $adress     = htmlspecialchars($_POST['adress']);
                        $zip_code   = htmlspecialchars($_POST['zip_code']);
                        $city       = htmlspecialchars($_POST['city']);
                        $email      = htmlspecialchars($_POST['email']);
                        $phone      = htmlspecialchars($_POST['phone']);
                        $job        = htmlspecialchars($_POST['job']);
                        $motivation = htmlspecialchars($_POST['motivation']);
                        sendEmailCandidacy(
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
                            $motivation);
                }
                else{recrut();}
            }
            else{throw new Exception("Cette page n'existe pas ou a été suprimée.");}
        }
        else{home();}
    }
    catch(Exception $e){
        // $error = $e->getMessage();
        // require('view/errorView.php');
        throw new Exception('Erreur : '.$e->getMessage());
    }