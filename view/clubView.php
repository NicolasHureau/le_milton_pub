<?php
    ob_start();
    if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'Admin'){
?>
<!-- Affichage liste des utilisateurs, administrator only -->
    <section class="container d-flex flex-column flex-grow-1">
        <table>
            <thead>
                <h3 class="text-center"><u><strong>Liste des inscrits</strong></u></h3>
            </thead>
            <tbody class="text-center">
                <?php while($user = $requestAdmin->fetch()){ ?>
                    <tr>
                        <td rowspan="2"><?= $user['id'] ?></td>
                        <th><?= $user['pseudo'] ?></th>
                        <td>Inscrit(e) le : <?= AdminManager::seeDateFr($user['creation_date']) ?></td>
                        <td><?= $user['role'] ?></td>
                        <td rowspan="2"><button type="button">Modifier</button></td>
                    </tr>
                    <tr>
                        <td><?= $user['first_name'].' '.$user['last_name'] ?></td>
                        <td> Né(e) le : <?= AdminManager::seeDateFr($user['birthday']); ?></td>
                        <td><?= $user['email'] ?></td>
                    </tr>
                        <!-- accordion? + modal de modif -->
                <?php } ?>
            </tbody>
        </table>
    </section>
<?php }else{ ?>
<!-- Création de compte -->
    <section class="container d-flex flex-column align-items-center justify-content-center flex-grow-1">
        <p class=" my-3">
            Adhérer au Milton Club vous permettra...
        </p>
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
                        <div class="col-auto">
                            <input type="text" name="pseudo" class="form-control text-center" placeholder="Un pseudo"  required>
                        </div>
                    </div>
                    <div class="row g-3 mt-1">
                        <div class="col">
                            <input type="text" name="first_name" class="form-control" placeholder="Votre prénom"  required>
                        </div>
                        <div class="col">
                            <input type="text" name="last_name" class="form-control" placeholder="Votre nom"  required>
                        </div>
                    </div>
                    <div class="row text-end align-items-center g-3 mt-1">
                        <div class="col">
                            <label for="birthday">Votre date de naissance :</label>
                        </div>
                        <div class="col">
                            <input type="date" name="birthday" class="form-control" id="birthday"  required>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-auto">
                            <input type="email" name="email" class="form-control text-center" placeholder="Votre adresse Email"  required>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-auto">
                            <input type="password" name="password" class="form-control text-center" placeholder="Mot de passe"  required />
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-auto">
                            <input type="password" name="password_two" class="form-control text-center" placeholder="Retapez votre mot de passe"  required />
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success px-5">S'inscrire</button>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <a href="index.php?page=connection" class="text-decoration-none">Déjà inscrit?</a>
                    </div>
                </form>
            </div>
        <?php } ?>
    </section>
<?php
    }
    $content = ob_get_clean();
    require('menu.php');
?>