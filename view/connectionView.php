<?php
    ob_start();
?>
    <section class="container mt-3 d-flex flex-column align-items-center justify-content-center" style="height:100vh">
    <?php
        if(isset($_GET['error'])){
            if(isset($_GET['message'])){
                echo'<div class="alert alert-danger text-center">'.htmlspecialchars($_GET['message']).'</div>';
            }
        }
        if(isset($_GET['logedout'])){
            echo'<div class="alert alert-warning text-center px-5">Vous êtes déconnecter.</div>';
        }
        if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1){
    ?>
        <h1 class="text-center m-5">Bonjour <?= $_SESSION['pseudo'] ?> !</h1>
        <div class="alert alert-success text-center m-0">Vous êtes connecter.</div>
        <a href="index.php?page=connection&logout" class="d-flex justify-content-end text-decoration-none">Se déconnecter.</a>
    <?php }else{ ?>
        <div>
            <form method="post" action="index.php?page=connection">
                <div class="row mt-3">
                    <input type="email" name="email" class="form-control text-center" placeholder="Votre adresse Email" required>
                </div>
                <div class="row mt-3">
                    <input type="password" name="password" class="form-control text-center" placeholder="Mot de passe" required />
                </div>
                <div class="row justify-content-center mt-3 col-auto">
                    <button type="submit" class="btn btn-success px-5">Se connecter</button>
                </div>
                <div class="text-center mb-3">
                    <a href="index.php?page=club" class="text-decoration-none">Pas encore inscrit?</a>
                </div>
            </form>
        </div>
    <?php } ?>
    </section>
<?php
    $content = ob_get_clean();
    require('menu.php');
?>