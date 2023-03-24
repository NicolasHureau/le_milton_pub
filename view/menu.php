<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Milton Pub - Annecy</title>
    <link rel="stylesheet" href="public/design/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body <?php if(empty($_GET) || $_GET['page'] == 'home' AND empty($_SESSION) || $_SESSION['role'] !== 'Admin'){ echo'style="height: 100vh;"';}else{ echo'style="min-height: 100vh;"';} ?> >
    <header class="sticky-top shadow px-4">
        <h1 class="text-center text-white m-0 d-none d-sm-block">Le <span class="display-1">Milton</span> Pub</h1>
        <nav class="navbar navbar-expand-sm navbar-dark">
            <a class="navbar-brand d-sm-none" href="index.php">Le <span class="display-1">Milton</span> Pub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expand="false" aria-label="bouton de navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbar">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($_GET['page'])&&($_GET['page']=='home')){echo'active';} ?>" href="index.php?page=home">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($_GET['page'])&&($_GET['page']=='restaurant')){echo'active';} ?>" href="index.php?page=restaurant">Le Restaurant</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="sousMenuBar" role="button" data-bs-toggle="dropdown" aria-expanded="false">Le Bar</a>
                        <ul class="dropdown-menu" aria-labelledby="sousMenuBar">
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='drinks')){echo'active';} ?>" href="index.php?page=drinks">Carte des boissons</a></li>
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='wines')){echo'active';} ?>" href="index.php?page=wine">Cave à vins</a></li>
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='alcool')&&($_GET['type']=='whisky')){echo'active';} ?>" href="index.php?page=alcool&type=whisky">Encyclopédie des <strong>Whiskys</strong></a></li>
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='alcool')&&($_GET['type']=='rhum')){echo'active';} ?>" href="index.php?page=alcool&type=rhum">Route des <strong>Rhums</strong></a></li>
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='alcool')&&($_GET['type']=='tequila')){echo'active';} ?>" href="index.php?page=alcool&type=tequila">Hacienda des <strong>Téquilas</strong></a></li>
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='alcool')&&($_GET['type']=='vodka')){echo'active';} ?>" href="index.php?page=alcool&type=vodka">Toundra des <strong>Vodkas</strong></a></li>                       
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='alcool')&&($_GET['type']=='gin')){echo'active';} ?>" href="index.php?page=alcool&type=gin">Officine des <strong>Gins</strong></a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="sousMenuClub" role="button" data-bs-toggle="dropdown" aria-expanded="false">Le Milton-Club</a>
                        <ul class="dropdown-menu" aria-labelledby="sousMenuClub">
                        <?php if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1){ ?>
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='club')){echo'active';} ?>" href="index.php?page=club">Milton-Club</a></li>                       
                            <li><hr class="dropdown-divider"></li>
                            <li><h1 class="dropdown-item"><?= $_SESSION['pseudo'] ?></h1></li>
                            <li><a class="dropdown-item" href="index.php?page=connection&logout">Se déconnecter</a></li>
                        <?php }else{ ?>
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='connection')){echo'active';} ?>" href="index.php?page=connection">Déjà membre?</a></li>
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='club')){echo'active';} ?>" href="index.php?page=club">Rejoindre le Milton-Club</a></li>
                        <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="sousMenuContacts" role="button" data-bs-toggle="dropdown" aria-expanded="false">Contacts</a>
                        <ul class="dropdown-menu" aria-labelledby="sousMenuContacts">
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='info')){echo'active';} ?>" href="index.php?page=info">Informations utiles</a></li>
                            <li><a class="dropdown-item <?php if(isset($_GET['page'])&&($_GET['page']=='recrut')){echo'active';} ?>" href="index.php?page=recrut">Recrutement</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <?= $content ?>

    <footer class="text-end py-2 px-5">
        <a href="#" class="link-light text-decoration-none">© HuNic</a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>