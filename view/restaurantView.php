<?php
    ob_start();
    if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'admin'){
?>
<!-- liste des pages pour le carousel des menus, administrator only -->
    <section class="container flex-grow-1">
        <h2 class="text-center my-3"><b>Liste des pages</b></h2>
        <?php
            if(isset($_GET['error'])){
                echo'<div class="alert alert-danger text-center">'.htmlspecialchars($_GET['message']).'</div>';
            }
            if(isset($_GET['success'])){
                echo'<div class="alert alert-success text-center">'.htmlspecialchars($_GET['message']).'</div>';
            }
        ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            <?php while($page = $requestAdmin->fetch()){ ?>
                <div class="col">
                    <div class="card" style="height: 400px">
                        <div class="card-body">
                            <h5 class="card-title text-center">Page <?= $page['id'] ?></h5>
                        </div>
                        <img src="<?= $page['image'] ?>" class="card-img overflow-hidden object-fit-cover" alt="Page n° <?= $page['id'] ?>">
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <?php if($page['active'] == 1){echo '<span class="text-success">Affiché</span>';}else{echo '<span class="text-danger">Caché</span>';} ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update<?= $page['id'] ?>">Modifier</button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="update<?= $page['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?= $page['title'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-full screen-sm-down">
                        <div class="modal-content bg-dark text-light">
                            <form method="post" action="index.php?page=<?= $menu ?>" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5">Modifier la page n°<?= $page['id'] ?></h2>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="image" class="form-label text-center">Selectionnez une <b>nouvelle</b> page</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="active" name="active" <?php if($page['active'] == 1){echo 'checked';} ?>>
                                        <label class="form-check-label" for="active">Activer</label>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" name="update" value="<?= $page['id'] ?>" class="btn btn-success">Valider</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
<!-- Création d'une page pour le carousel des menus, administrator only -->
        <div class="text-center">
            <button type="button" class="btn btn-success px-5 my-5" data-bs-toggle="modal" data-bs-target="#new">Ajouter une page</button>
        </div>
        <div class="modal fade" id="new" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Nouvelle Actualitée" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-full screen-sm-down">
                <div class="modal-content bg-dark text-light">
                    <form method="post" action="index.php?page=<?= $menu ?>" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5">Nouvelle page</h2>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="image" class="form-label text-center">Selectionnez une page</label>
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
    </section>
<?php }else{ ?>
<!-- Carousel -->
    <section class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div id="carousel" class="carousel slide">
            <div class="carousel-inner">
                <?php while($page = $request->fetch()){ ?>
                    <div class="carousel-item <?php if($page['id'] === 1){echo 'active';} ?> ">
                        <img src="<?= $page['image'] ?>" class="w-100 px-md-5" alt="page n°<?= $page['id'] ?>">
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