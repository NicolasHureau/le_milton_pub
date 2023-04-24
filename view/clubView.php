<?php
    ob_start();
    if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'admin'){
?>
<!-- Affichage liste des utilisateurs, administrator only -->
    <section class="container d-flex flex-column flex-grow-1">
        <?php
            if(isset($_GET['error'])){
                echo'<div class="alert alert-danger text-center">'.htmlspecialchars($_GET['message']).'</div>';
            }
            if(isset($_GET['success'])){
                echo'<div class="alert alert-success text-center">'.htmlspecialchars($_GET['message']).'</div>';
            }
        ?>
        <h3 class="text-center my-3"><u><strong>Liste des inscrits</strong></u></h3>
        <?php while($user = $requestAdmin->fetch()){ ?>
            <div class="card my-1">
                <div class="card-header d-flex justify-content-between">
                    <span><?= $user['id'] ?></span>
                    <span><b><?= $user['pseudo'] ?></b></span>
                    <span><?php if($user['role'] == 'admin'){echo 'Manager';}
                                if($user['role'] == 'staff'){echo 'Staff';}
                                if($user['role'] == 'customer'){echo 'Client';} ?></span>
                                <!-- Vip + colorations -->
                </div>
                <div class="card-body">
                    <div>
                        <span><?= $user['first_name'] ?></span>
                        <span><?= $user['last_name'] ?></span>
                    </div>
                    <div>
                        Né(e) le : <?= SecurityManager::seeDateFr($user['birthday']); ?>
                    </div>
                    <div>
                        Email : <?= $user['email'] ?>
                    </div>
                    <div>
                        Inscrit(e) le : <?= SecurityManager::seeDateFr($user['creation_date']) ?>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <?php if($user['ban'] == 1){echo '<span class="text-danger">Ban</span>';}else{echo '<span class="text-success">Ok</span>';} ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update<?= $user['id'] ?>">Modifier</button>
                </div>
            </div>
            <div class="modal fade" id="update<?= $user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?= $user['pseudo'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-full screen-sm-down">
                    <div class="modal-content bg-dark text-light">
                        <form method="post" action="index.php?page=club">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5"><?= $user['pseudo'] ?> (id : <?= $user['id'] ?>)</h2>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row justify-content-center g-3">
                                    <div class="col">
                                        <input type="text" name="pseudo" class="form-control" value="<?= $user['pseudo'] ?>">
                                    </div>
                                    <div class="col">
                                        <select name="role" id="role" class="form-select">
                                            <option value="admin" <?php if($user['role'] == 'admin'){echo 'selected';} ?>>Manager</option>
                                            <option value="staff" <?php if($user['role'] == 'staff'){echo 'selected';} ?>>Staff</option>
                                            <option value="customer" <?php if($user['role'] == 'customer'){echo 'selected';} ?>>Client</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col">
                                        <input type="text" name="first_name" class="form-control" value="<?= $user['first_name'] ?>">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="last_name" class="form-control" value="<?= $user['last_name'] ?>">
                                    </div>
                                </div>
                                <div class="row text-end align-items-center g-3 mt-1">
                                    <div class="col">
                                        <label for="birthday">Date de naissance :</label>
                                    </div>
                                    <div class="col">
                                        <input type="date" name="birthday" class="form-control" id="birthday" value="<?= $user['birthday'] ?>">
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <div class="col-auto">
                                        <input type="email" name="email" class="form-control text-center" value="<?= $user['email'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="active" name="ban" <?php if($user['ban'] == 1){echo 'checked';} ?>>
                                    <label class="form-check-label text-danger" for="ban">Bannir</label>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" name="update" value="<?= $user['id'] ?>" class="btn btn-success">Modifier</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
<?php }else{ ?>
<!-- Création de compte -->
    <section class="container d-flex flex-column align-items-center justify-content-center flex-grow-1">
        <p class="text-center my-3">
            Adhérer au Milton Club vous permettra de laisser des commentaires sur les spiritueux que vous avez préféré pour faire part de vos dégustations aux autres et vous y référer lors de prochaines dégustations.<br><br>
            Et bientôt d'autres fonctionnalitées...
        </p>
        <div class="my-5">
            LOGO
        </div>
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
                            <label for="birthday">Date de naissance :</label>
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