<?php
    ob_start();
    if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'admin'){
?>
<!-- liste des actualitées pour le carousel, administrator only -->
    <section class="container flex-grow-1">
        <h2 class="text-center my-3"><b>Liste des Actualitées</b></h2>
        <?php
            if(isset($_GET['error'])){
                echo'<div class="alert alert-danger text-center">'.htmlspecialchars($_GET['message']).'</div>';
            }
            if(isset($_GET['success'])){
                echo'<div class="alert alert-success text-center">'.htmlspecialchars($_GET['message']).'</div>';
            }
        ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            <?php while($listNews = $requestAdmin->fetch()){ ?>
                <div class="col">
                    <div class="card" style="height: 400px">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $listNews['title'] ?></h5>
                            <p class="card-text text-center"><?= $listNews['content'] ?></p>
                        </div>
                        <img src="<?= $listNews['image'] ?>" class="card-img overflow-hidden object-fit-cover" alt="Image pour <?= $listNews['title'] ?>">
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <?php if($listNews['active'] == 1){echo '<span class="text-success">Affiché</span>';}else{echo '<span class="text-danger">Caché</span>';} ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update<?= $listNews['id'] ?>">Modifier</button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="update<?= $listNews['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?= $listNews['title'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-full screen-sm-down">
                        <div class="modal-content bg-dark text-light">
                            <form method="post" action="index.php?page=home" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5">Modifier l'actualitée n°<?= $listNews['id'] ?></h2>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" class="form-control fs-5" name="title" value="<?= $listNews['title'] ?>">
                                    <textarea type="text" class="form-control my-3" name="content" row="5"><?= $listNews['content'] ?></textarea>
                                    <label for="image" class="form-label text-center">Selectionnez une <b>nouvelle</b> image de fond</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="active" name="active" <?php if($listNews['active'] == 1){echo 'checked';} ?>>
                                        <label class="form-check-label" for="active">Activer</label>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" name="update" value="<?= $listNews['id'] ?>" class="btn btn-success">Valider</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
<!-- Création d'actualitée pour le carousel, administrator only -->
        <div class="text-center">
            <button type="button" class="btn btn-success px-5 my-5" data-bs-toggle="modal" data-bs-target="#new">Ajouter une Actualité</button>
        </div>
        <div class="modal fade" id="new" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Nouvelle Actualitée" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-full screen-sm-down">
                <div class="modal-content bg-dark text-light">
                    <form method="post" action="index.php?page=home" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5">Nouvelle actualitée</h2>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control fs-5" name="title" placeholder="Titre" required>
                            <textarea class="form-control my-3" name="content" row="5" placeholder="Description" required></textarea>
                            <label for="image" class="form-label text-center">Selectionnez image de fond</label>
                            <input type="file" class="form-control" name="image" id="image" required>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="active" name="active" checked>
                                <label class="form-check-label" for="active">Activer</label>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" name="new" class="btn btn-success">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div>
<!-- Modification premiére de carousel, administrator only -->
        </div>
    </section>
<?php }else{ ?>
<!-- Carousel -->
    <section class="overflow-hidden">
        <div id="carousel" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="../public/assets/uploads/leschampions.jpg" class="min-vh-100 min-vw-100 object-fit-cover overflow-hidden" alt="Le Milton Pub">
                    </div>
                    <div class="carousel-caption d-block bg-success rounded" style="--bs-bg-opacity: .4;">
                        <h4 class="display-4">Bienvenue</h4>
                        <p>Toute l'équipe du Milton Pub est fiére de vous acceuillir au coeur de la vieille-ville d'Annecy.</p>
                    </div>
                </div>
                <?php while($carouselNews = $requestCarousel->fetch()){ ?>
                    <div class="carousel-item h-100">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="../<?= $carouselNews['image'] ?>" class="min-vh-100 min-vw-100 object-fit-cover overflow-hidden" alt="Image pour<?= $carouselNews['title'] ?>">
                        </div>
                        <div class="carousel-caption d-block bg-success rounded" style="--bs-bg-opacity: .4;">
                            <h4><?= $carouselNews['title'] ?></h4>
                            <p><?= $carouselNews['content'] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
<?php
    }
    $content = ob_get_clean();
    require('menu.php');
?>