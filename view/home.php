<?php
    ob_start();
?>
<!-- carousel -->
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
<?php if(isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['role'] == 'Admin'){ ?>
<!-- liste des news pour le carousel, only manager -->
    <section class="container mt-3">
        <p class="text-center"><b>Liste des Actualitées</b></p>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        <?php while($listNews = $requestAdmin->fetch()){ ?>
            <div class="col">
                <div class="card" style="height: 400px">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $listNews['title'] ?></h5>
                        <p class="card-text text-center"><?= $listNews['content'] ?></p>
                    </div>
                    <img src="<?= $listNews['image'] ?>" class="card-img overflow-hidden object-fit-cover" alt="Image pour <?= $listNews['title'] ?>">
                </div>
            </div>
        <?php } ?>
        </div>
    </section>
<!-- création de news pour le carousel, only manager -->
    <Section class="container my-3 d-flex flex-column align-items-center">
        <div>
            <p class="text-center"><b>Créer une actualitée</b></p>
            <form method="post" action="index.php" enctype="multipart/form-data">
                <div class="row">
                    <p><input type="text" class="form-control text-center" name="title" id="title" placeholder="Titre"></p>
                </div>
                <div class="row">
                    <p><textarea class="form-control text-center" name="content" id="content" row="5" placeholder="commentaire"></textarea></p>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <label for="image" class="form-label text-center">Selectionnez une image de fond</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                </div>
                <div class="row justify-content-center m-3">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success px-5">Ajouter l'actualitée</button>
                    </div>
                </div>
            </form>
        </div>
    </Section>
<?php
    }
    $content = ob_get_clean();
    require('menu.php');
?>