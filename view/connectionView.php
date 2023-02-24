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
        if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1){
            echo'<h1 class="text-center">Bonjour '.$_SESSION['pseudo'].' !</h1>';
            echo'<div class="alert alert-success text-center">Vous êtes bien connecter.</div>';
            echo'<a href="index.php?page=connection&logout=1" class="d-flex justify-content-end text-decoration-none">Se déconnecter.</a>';
        }else{
    ?>
        <div>
            <form method="post" action="index.php?page=connection">
                <div class="row mt-3">
                    <div>
                        <input type="email" name="email" class="form-control text-center" placeholder="Votre adresse Email" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div>
                        <input type="password" name="password" class="form-control text-center" placeholder="Mot de passe" required />
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success px-5">Se connecter</button>
                    </div>
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