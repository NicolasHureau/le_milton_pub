<?php
    ob_start();
?>
    <section class="container w-50 mt-3">
        <div class="p-5 text-center">
            Logo
        </div>
        <p class="p-5">
            Adhérer au Milton Club vous permettra...
        </p>
    </section>
    <section class="container w-50 mt-3">
    <?php
        if(isset($_GET['error'])){
            if(isset($_GET['message'])){
                echo'<div class="alert alert-danger text-center">'.htmlspecialchars($_GET['message']).'</div>';
            }
        }
        if(isset($_SESSION['connect'])){
            echo'<div class="alert alert-success text-center">Vous êtes déjà inscrit.</div>';
        }else{
    ?>
        <div>
            <form method="post" action="index.php?page=club">
                <div class="row justify-content-center g-3">
                    <div class="col-6">
                        <input type="text" name="pseudo" class="form-control" placeholder="Un pseudo" require>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col">
                        <input type="text" name="first_name" class="form-control" placeholder="Votre prénom" require>
                    </div>
                    <div class="col">
                        <input type="text" name="last_name" class="form-control" placeholder="Votre nom" require>
                    </div>
                </div>
                <div class="row justify-content-center g-3 mt-1">
                    <div class="col-4">
                        <label for="birthday">Votre date d'anniversaire :</label>
                    </div>
                    <div class="col-4">
                        <input type="date" name="birthday" class="form-control" id="birthday" require>
                    </div>
                </div>
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
                <div class="row justify-content-center mt-3">
                    <div class="col-6">
                        <input type="password" name="password_two" class="form-control" placeholder="Retapez votre mot de passe" required />
                    </div>
                </div>
                <div class="row justify-content-center my-3">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success px-5">S'inscrire</button>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>
    </section>
    
<?php
    $content = ob_get_clean();
    require('menu.php');
?>