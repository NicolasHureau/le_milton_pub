<?php
    ob_start();
?>
    <section class="container w-50 h-100 mt-3">
    <?php if(isset($_GET['error'])){
        if(isset($_GET['message'])){
            echo'<div class="alert alert-danger">'.htmlspecialchars($_GET['message']).'</div>';
        }
    } ?>
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
                        <input type="email" name="email" class="form-control" placeholder="Votre Email" required>
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
                <div class="row justify-content-center mt-3">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success px-5">S'inscrire</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
<?php
    $content = ob_get_clean();
    require('base.php');
?>