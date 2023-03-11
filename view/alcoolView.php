<?php
    ob_start();
?>
    <section class="container my-3 flex-grow-1">
<!-- Création de fiche alcool, admin only -->
        <?php if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'Admin'){ ?>
            <div class="text-center mb-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newAlcool">Ajouter un nouveau produit</button>
            </div>
            <div class="modal fade" id="newAlcool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addNewAlcool" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-full screen-sm-down">
                    <div class="modal-content bg-dark text-light">
                        <form method="post" action="index.php?page=alcool&success=1&message=Le nouveau tord-boyaux à été envoyé à la base de donnée." enctype="multipart/form-data">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5" id="addNewAlcool">Ajouter un alcool</h2>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-2 g-2">
                                    <div class="col">
                                        <input type="text" class="form-control" name="name" placeholder="Nom" required>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control text-center px-0" name="degree" required>
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2 g-2">
                                    <div class="col">
                                        <input class="form-control" list="typeOpt" name="type" placeholder="Type d'alcool" required>
                                            <datalist id="typeOpt">
                                                <option value="Whisky">
                                                <option value="Rhum">
                                                <option value="Gin">
                                                <option value="Vodka">
                                                <option value="Téquila">
                                                <option value="Liqueur">
                                                <option value="Digestif">
                                            </datalist>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" list="categoryOpt" name="category" placeholder="Catégorie">
                                            <datalist id="categoryOpt">
                                                    <option value="Single Cask">
                                                    <option value="Single Malt">
                                                    <option value="Pure Malt">
                                                    <option value="Blended">
                                                    <option value="Single Grain">
                                                    <option value="Scotch">
                                                    <option value="Irish">
                                                    <option value="Bourbon">
                                                    <option value="Rye">
                                                    <option value="Tennessee">
                                                    <option value="Blanc">
                                                    <option value="Ambré">
                                                    <option value="Vieux">
                                                    <option value="Mélasse">
                                                    <option value="Navy">
                                                    <option value="Prémium">
                                                    <option value="Vintage">
                                                    <option value="Overproof">
                                                    <option value="Agricole">
                                            </datalist>
                                    </div>
                                </div>
                                <input type="text" class="form-control mb-2" name="origin" placeholder="Origine">
                                <label for="image" class="form-label text-center">Selectionnez image</label>
                                <input type="file" class="form-control mb-2" name="image" id="image">
                                <textarea class="form-control mb-2" rows="3" name="presentation" placeholder="Présentation"></textarea>
                                <textarea class="form-control mb-2" rows="3" name="degustation" placeholder="Notes de dégustations"></textarea>
                                <div class="row d-flex align-items-center g-1">
                                    <div class="col text-end">
                                        <label for="price2cl" class="form-label m-0">prix 2cl. :</label>
                                    </div>
                                    <div class="input-group col">
                                        <input type="text" class="form-control text-center p-1" name="price2cl" id="price2cl" required>
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <div class="col text-end">
                                        <label for="price4cl" class="form-label m-0">prix 4cl. :</label>
                                    </div>
                                    <div class="input-group col">
                                        <input type="text" class="form-control text-center p-1" name="price4cl" id="price4cl" required>
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
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
        <?php } ?>
<!-- liste des alcools -->
        <div class="accordion" id="accordionAlcool">
            <?php while($alcool = $requestAlcool->fetch()){ ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="<?= $alcool['id'] ?>">
                    <button class="accordion-button collapsed p-1" type="button" data-bs-toggle="collapse" data-bs-target="#description<?= $alcool['id'] ?>" aria-expanded="true" aria-controls="description<?= $alcool['id'] ?>">
                        <h5 class="text-truncate flex-grow-1 m-0"><?= $alcool['name'] ?></h5>
                        <div class="d-flex flex-column flex-sm-row ">
                            <span class="me-2"><u>2cl. :</u> <?= $alcool['price2cl'] ?></span>
                            <span class="me-2"><u>4cl. :</u> <?= $alcool['price4cl'] ?></span>
                        </div>
                    </button>
                    </h2>
                    <div id="description<?= $alcool['id'] ?>" class="accordion-collapse collapse" aria-labelledby="<?= $alcool['id'] ?>" data-bs-parent="#accordionAlcool">
                        <div class="accordion-body">
                            <div class="hstack">
                                <div class="text-secondary"><?= $alcool['origin'] ?></div>
                                <div class="text-secondary ms-auto"><?= $alcool['category'] ?></div>
                            </div>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 align-items-center">
                                <div class="col text-center">
                                    <img src="<?= $alcool['image'] ?>" class="img-fluid" alt="image pour <?= $alcool['name'] ?>" style="max-height: 300px;">
                                </div>
                                <div class="col">
                                    <p><?php echo nl2br($alcool['presentation']) ?></p>
                                </div>
                                <div class="col">
                                    <p><u>Notes de dégustation :</u><br><br><?php echo nl2br($alcool['degustation']) ?></p>
                                </div>

                            </div>
                            <?php if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'Admin'){ ?>
                                <div class="accordion-footer d-flex justify-content-between align-items-center">
                                    <?php if($alcool['active'] == 1){echo '<span class="text-success">Affiché</span>';}else{echo '<span class="text-danger">Caché</span>';} ?>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifier<?= $alcool['id'] ?>">Modifier</button>
                                </div>
                        </div>
                    </div>
                </div>
<!-- Modification de fiche alcool, Admin only -->
                <div class="modal fade" id="modifier<?= $alcool['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?= $alcool['name'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-full screen-sm-down">
                        <div class="modal-content bg-dark text-light">
                        <form method="post" action="index.php?page=alcool" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5">Modifier <?= $alcool['name'] ?> (id : <?= $alcool['id'] ?>)</h2>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-2 g-2">
                                    <div class="col">
                                        <input type="text" class="form-control" name="name" value="<?= $alcool['name'] ?>">
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control text-center px-0" name="degree" value="<?= $alcool['degree'] ?>">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2 g-2">
                                    <div class="col">
                                    <input class="form-control" list="typeOpt" name="type" placeholder="Type d'alcool" value="<?= $alcool['type'] ?>" required>
                                            <datalist id="typeOpt">
                                                <option value="Whisky">
                                                <option value="Rhum">
                                                <option value="Gin">
                                                <option value="Vodka">
                                                <option value="Téquila">
                                                <option value="Liqueur">
                                                <option value="Digestif">
                                            </datalist>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" list="categoryOpt" name="category" placeholder="Catégorie" value="<?= $alcool['category'] ?>">
                                            <datalist id="categoryOpt">
                                                    <option value="Single Cask">
                                                    <option value="Single Malt">
                                                    <option value="Pure Malt">
                                                    <option value="Blended">
                                                    <option value="Single Grain">
                                                    <option value="Scotch">
                                                    <option value="Irish">
                                                    <option value="Bourbon">
                                                    <option value="Rye">
                                                    <option value="Tennessee">
                                                    <option value="Blanc">
                                                    <option value="Ambré">
                                                    <option value="Vieux">
                                                    <option value="Mélasse">
                                                    <option value="Navy">
                                                    <option value="Prémium">
                                                    <option value="Vintage">
                                                    <option value="Overproof">
                                                    <option value="Agricole">
                                    </div>
                                </div>
                                <input type="text" class="form-control mb-2" name="origin" value="<?= $alcool['origin'] ?>">
                                <label for="image" class="form-label text-center">Selectionnez une <b>nouvelle</b> image</label>
                                <input type="file" class="form-control mb-2" name="image" id="image">
                                <textarea class="form-control mb-2" rows="3" name="presentation" placeholder="Présentation"><?= $alcool['presentation'] ?></textarea>
                                <textarea class="form-control mb-2" rows="3" name="degustation" placeholder="Notes de dégustations"><?= $alcool['degustation'] ?></textarea>
                                <div class="row d-flex align-items-center g-1">
                                    <div class="col text-end">
                                        <label for="price2cl" class="form-label m-0">prix 2cl. :</label>
                                    </div>
                                    <div class="input-group col">
                                        <input type="text" class="form-control text-center p-1" name="price2cl" id="price2cl" value="<?=$alcool['price2cl'] ?>">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <div class="col text-end">
                                        <label for="price4cl" class="form-label m-0">prix 4cl. :</label>
                                    </div>
                                    <div class="input-group col">
                                        <input type="text" class="form-control text-center p-1" name="price4cl" id="price4cl" value="<?= $alcool['price4cl'] ?>">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="active" name="active" <?php if($alcool['active'] == 1){echo 'checked';} ?>>
                                    <label class="form-check-label" for="active">Activer</label>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" name="maj" value="<?= $alcool['id'] ?>" class="btn btn-success">Valider</button>
                                </div>
                            </div>
                        </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php
    $content = ob_get_clean();
    require('menu.php');
?>