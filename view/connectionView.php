<?php
    ob_start();
?>
    <section id="connect" class="container w-50 mt-3">
    <?php
        if(isset($_GET['error'])){
            if(isset($_GET['message'])){
                echo'<div class="alert alert-danger text-center">'.htmlspecialchars($_GET['message']).'</div>';
            }
        }
    ?>
        <div>
            <?php
                if(isset($_SESSION['connect'])){
                    echo'<h1 class="text-center">Bonjour '.$_SESSION['pseudo'].' !</h1>';
                    echo'<div class="alert alert-success text-center">Vous êtes bien connecter.</div>';
                }else{
            ?>
            <form method="post" action="index.php?page=connection">
                <div class="row justify-content-center mt-3">
                    <div class="col-6">
                        <input type="email" name="email" class="form-control" placeholder="Votre adresse Email" required>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-6">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
                    </div>
                </div>
                <div class="row justify-content-center my-3">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success px-5">Se connecter</button>
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </section>
<?php
    $content = ob_get_clean();
    require('menu.php');
?>