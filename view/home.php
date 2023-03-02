<?php
    ob_start();
    if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'Admin'){
?>
<!-- liste des news pour le carousel, administrator only -->
    <section class="container">
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifier<?= $listNews['id'] ?>">Modifier</button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modifier<?= $listNews['id'] ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="<?= $listNews['title'] ?>" aria-hidden="true">
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
                                <label for="image" class="form-label text-center">Selectionnez une nouvelle image de fond</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="active" name="active" <?php if($listNews['active'] == 1){echo 'checked';} ?>>
                                    <label class="form-check-label" for="active">Activer</label>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" name="maj" value="<?= $listNews['id'] ?>" class="btn btn-success">Valider</button>
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
            <button type="button" class="btn btn-success px-5 my-5" data-bs-toggle="modal" data-bs-target="#nouvelleActu">Ajouter une Actualité</button>
        </div>
        <div class="modal fade" id="nouvelleActu" data-bs-backdrop="static" tabindex="-1" aria-labelledby="Nouvelle Actualitée" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-full screen-sm-down">
                    <div class="modal-content bg-dark text-light">
                        <form method="post" action="index.php?page=home" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5">Nouvelle actualitée</h2>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="form-control fs-5" name="title" placeholder="Titre" required>
                                <textarea type="text" class="form-control my-3" name="content" row="5" placeholder="Description" required></textarea>
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
    </section>
    <section>
        <h2 class="text-center my-3"><b>Page d'acceuil</b></h2>
        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ultricies consequat lectus id feugiat. Nunc tristique velit quis urna convallis vestibulum. Aliquam id fringilla ante. Duis fringilla nibh sit amet felis pulvinar iaculis. Quisque sollicitudin fermentum ligula vitae vestibulum. Sed tincidunt maximus commodo. In id convallis lorem.

Nunc posuere, elit sit amet porttitor luctus, lorem quam ultrices diam, ut mollis felis mi a purus. Phasellus justo eros, consectetur at tempor a, suscipit sed turpis. Proin vel ante velit. Nam augue nulla, tempor ac risus a, aliquam finibus tellus. Pellentesque eget ligula porta, fringilla eros quis, hendrerit quam. Sed nisi nibh, hendrerit id hendrerit in, sollicitudin et metus. Praesent bibendum viverra magna, quis accumsan risus fermentum ut. Aliquam feugiat dui non quam commodo, at pellentesque tortor vulputate. Aenean id mauris sem. Sed eu nisi sed enim dictum tempus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tellus justo, condimentum et euismod at, mattis id justo. Curabitur quis tristique lorem.

Fusce a facilisis mauris. Donec sodales nisi vitae massa lobortis, et scelerisque ligula mollis. Nulla cursus, nisi pellentesque auctor elementum, eros massa ornare metus, sed euismod risus nunc sed lectus. Aliquam erat volutpat. Aenean facilisis est nec aliquet elementum. Sed mollis ligula nisi, quis consequat dolor efficitur vel. Nam lectus augue, aliquam lobortis tristique a, efficitur et dolor. Quisque varius elit sit amet lectus aliquet, sed rhoncus mi interdum. Ut eleifend ante at elit luctus, ac suscipit velit tempor. Vivamus facilisis feugiat tincidunt. Etiam non dolor semper, tempus dolor eget, cursus dui. Cras posuere velit eu dolor venenatis, non feugiat velit ullamcorper. Quisque ligula lacus, dictum et tellus in, imperdiet faucibus est. Quisque ornare orci eu lobortis fermentum. Nulla facilisis congue pellentesque. Ut et convallis ex.

Nulla finibus tincidunt purus, ac volutpat sem iaculis et. Cras vulputate velit id varius faucibus. Cras risus mi, iaculis sed vestibulum et, aliquam eget tortor. Sed suscipit arcu vel bibendum posuere. Donec nec viverra libero, ac condimentum dolor. Mauris rhoncus, leo vel pulvinar accumsan, lorem nisl scelerisque dolor, et ullamcorper orci lacus ut nunc. Etiam molestie ipsum non enim iaculis interdum. Suspendisse vitae neque a leo lacinia facilisis. Vivamus tempor, elit id tincidunt porttitor, sem metus porta lacus, id gravida dolor lacus quis elit. Vivamus fringilla auctor mi, in vehicula diam commodo eu. Nunc hendrerit magna dui, ut lobortis quam laoreet non. Sed eu orci nisl. Nam lectus eros, congue a efficitur in, ornare ac nisi. Sed varius egestas augue, sed porta risus sagittis nec.

Nullam eu tempor diam. Curabitur ut urna et ipsum dapibus vehicula. Aenean mattis, lacus vel finibus vehicula, felis turpis tincidunt nisi, fringilla consectetur ex lacus et risus. Integer at lectus a libero pretium tristique feugiat in lectus. Pellentesque mollis tristique convallis. Ut id dapibus mi, at volutpat mauris. In hac habitasse platea dictumst. Fusce luctus viverra purus nec imperdiet. Pellentesque ac nisl pharetra, elementum tortor ac, sagittis metus. Duis eu tempor est, sit amet interdum erat. In et massa tempus, ornare augue vel, tempor nisi.

Nulla vitae sem quis erat dignissim efficitur ut a tortor. Fusce maximus nisl non arcu blandit, quis pharetra turpis consectetur. In faucibus id tellus in maximus. Nullam tempor dapibus convallis. Mauris sit amet risus neque. Integer interdum ac libero ut finibus. In vel elementum quam. Pellentesque ac dolor vel est ultrices interdum eget et nisl. Pellentesque aliquam nisl nec mi sagittis gravida. Praesent fringilla magna a arcu fermentum, in sodales augue viverra. Vivamus at sapien metus. In fermentum ante vel scelerisque sagittis. Curabitur nec dictum turpis, id vehicula justo.

Mauris commodo massa eu augue dignissim elementum. Donec nulla dui, commodo nec facilisis non, blandit ac dui. Cras ex ipsum, tempor ut urna ac, volutpat efficitur tellus. Proin semper suscipit arcu vitae posuere. Morbi posuere pellentesque ex id ultricies. Vivamus placerat vitae erat nec malesuada. Praesent nec augue at nulla dignissim cursus. Nam tincidunt arcu sit amet dui lacinia, non iaculis lorem convallis.

Curabitur semper nunc ut nibh consectetur, vel laoreet sapien elementum. Nam at tristique sem. Donec finibus venenatis sapien et rhoncus. Ut velit erat, ultrices at pharetra ac, scelerisque vel ipsum. Fusce nulla dui, fringilla bibendum tincidunt id, dignissim sit amet turpis. Duis venenatis consectetur viverra. Fusce varius mollis leo vel malesuada. Sed sit amet massa eu neque iaculis commodo.

Cras dignissim tristique erat a ultrices. Integer vel ipsum quis elit blandit consectetur non non ante. Praesent dictum, nisl eget maximus elementum, mauris velit mollis mi, vel maximus enim orci id risus. Suspendisse tincidunt libero sed purus interdum, non malesuada odio pretium. Nullam auctor egestas malesuada. Donec at nisl est. Sed lacinia massa quam, ut blandit ligula congue et. Nullam et purus nec lorem iaculis viverra vel commodo enim. Praesent porttitor, felis non pretium gravida, leo arcu blandit mi, vel pellentesque justo felis porta magna.

Nunc imperdiet non purus eu efficitur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur tempor est augue, ullamcorper gravida mi condimentum quis. Nam dui augue, varius a lacinia non, tempus viverra nisl. Suspendisse leo urna, varius ac elementum hendrerit, venenatis non lacus. Duis eget dolor lacus. Vivamus pretium, purus at luctus tempor, massa urna placerat lectus, id vestibulum ligula nibh sed lectus. Ut orci quam, vehicula vitae neque eget, euismod sollicitudin mauris. Sed viverra dolor nec nisl maximus ultricies. Pellentesque id metus iaculis, ultricies diam lacinia, accumsan augue</p>
    </section>
<?php }else{ ?>
<!-- Carousel -->
<section class="h-100 overflow-hidden">
        <div id="carousel" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="../public/assets/uploads/leschampions.jpg" class="min-vh-100 min-vw-100 object-fit-cover" alt="Le Milton Pub">
                    </div>
                    <div class="carousel-caption d-block bg-success rounded" style="--bs-bg-opacity: .4;">
                        <h4 class="display-4">Bienvenue</h4>
                        <p>Toute l'équipe du Milton Pub est fiére de vous acceuillir au coeur de la vieille-ville d'Annecy.</p>
                    </div>
                </div>
            <?php while($carouselNews = $requestCarousel->fetch()){ ?>
                <div class="carousel-item h-100">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="../<?= $carouselNews['image'] ?>" class="min-vh-100 min-vw-100 object-fit-cover" alt="Image pour<?= $carouselNews['title'] ?>">
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