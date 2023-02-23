<?php
    ob_start();
?>
<!-- carousel -->
    <section class="container w-50 mt-3">
        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active overflow-hidden" style="height: 300px;">
                    <img src="../public/assets/uploads/leschampions.jpg" class="d-block w-100" alt="Le Milton Pub">
                    <div class="carousel-caption d-block bg-success rounded" style="--bs-bg-opacity: .4;">
                        <h4 class="display-4">Bienvenue</h4>
                        <p>Toute l'équipe du Milton Pub est fiére de vous acceuillir au coeur de la vieille-ville d'Annecy.</p>
                    </div>
                </div>
                <?php while($carouselNews = $requestCarousel->fetch()){ ?>
                <div class="carousel-item overflow-hidden" style="height: 300px;">
                    <img src="../<?= $carouselNews['image'] ?>" class="d-block w-100" alt="Image pour<?= $carouselNews['title'] ?>">
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
<!-- liste des news pour le carousel, only manager -->
    <section class="container mt-3">
        <p class="text-center"><b>Liste des Actualitées</b></p>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php while($listNews = $requestAdmin->fetch()){ ?>
                <div class="col">
                    <div class="card" style="height: 400px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $listNews['title'] ?></h5>
                            <p class="card-text"><?= $listNews['content'] ?></p>
                        </div>
                        <img src="<?= $listNews['image'] ?>" class="card-img overflow-hidden object-fit-cover" alt="Image pour <?= $listNews['title'] ?>">
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<!-- création de news pour le carousel, only manager -->
    <Section class="container w-50 mt-3">
        <form method="post" action="index.php" enctype="multipart/form-data">
            <p><input type="text" class="form-control" name="title" id="title" placeholder="Titre"></p>
            <p><textarea class="form-control" name="content" id="content" row="5"></textarea></p>
            <p>
                <label for="image" class="form-label">Selectionnez une image de fond</label>
                <input type="file" class="form-control" name="image" id="image">
            </p>
            <p class="text-center">
                <button type="submit" class="btn btn-success mb-3">Ajouter l'actualitée</button>
            </p>
        </form>
    </Section>
<!-- Présentation de l'établissement -->
    <section class="container w-50">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam felis lectus, ultricies vitae vehicula nec, rutrum id ex. Sed risus nisl, feugiat quis ligula aliquam, aliquet pellentesque lectus. In consectetur augue sit amet dictum interdum. Nullam lacinia vehicula arcu eu mattis. Aliquam volutpat quam est, et pharetra felis blandit vitae. Nam rhoncus, neque a hendrerit pharetra, ipsum ligula suscipit elit, non laoreet lorem mi at quam. Aenean ornare, sapien vel egestas tincidunt, nunc leo convallis arcu, vitae semper sapien est ut quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed maximus ultricies semper. Quisque commodo augue nibh. Morbi in quam eget eros dignissim ullamcorper non vel augue. Integer ac diam in lorem consectetur laoreet. Curabitur egestas urna dictum, varius enim sed, rhoncus urna.

            Maecenas accumsan tempus nibh, ut consequat nunc tempus eget. Mauris et lorem at sem tincidunt dictum ac et nisl. Nullam placerat purus congue quam aliquam pharetra. Sed id nisl a lectus porttitor imperdiet eget eget justo. Vestibulum est sem, tincidunt at mi non, posuere mollis turpis. Sed a quam lacus. Suspendisse vel augue consequat nisl finibus congue. Suspendisse tempor pulvinar odio, in eleifend ligula consectetur at. Maecenas eleifend dolor sed iaculis facilisis. Nulla sit amet sollicitudin tortor. In cursus fringilla lectus, vel ornare erat iaculis a. Phasellus purus odio, feugiat at porta non, mollis sit amet erat.

            Aenean id augue felis. Nunc cursus nibh vel enim convallis tristique. Suspendisse porttitor fringilla purus, eleifend varius purus fermentum rhoncus. Ut magna ipsum, tempus convallis vehicula id, semper a purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc urna dui, iaculis non felis id, dignissim fringilla neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent molestie pellentesque ex, non consequat ante placerat aliquet. Vivamus malesuada malesuada elementum. Nullam feugiat, elit id aliquet viverra, enim est convallis felis, ut tincidunt enim metus non ipsum. Ut et vestibulum lectus. Praesent ullamcorper iaculis vehicula. Nullam eget malesuada orci.

            Nulla turpis mi, euismod eget mattis et, viverra eu massa. Mauris nibh lacus, sollicitudin a dui vel, tincidunt dignissim nibh. Morbi tellus turpis, tincidunt ut orci consectetur, condimentum bibendum orci. Pellentesque ut massa odio. Proin ultrices ornare maximus. Sed maximus sapien at est semper volutpat. Nullam non metus arcu. Donec egestas elit vel augue scelerisque cursus. Ut leo turpis, feugiat eu leo vel, convallis aliquam eros. Mauris aliquet aliquam sem, eu aliquet elit. Phasellus justo massa, lacinia at elementum non, euismod ut diam. Integer rutrum varius dapibus.

            In aliquet volutpat enim id ornare. Phasellus mattis sit amet mauris nec rhoncus. Nam a augue quis erat facilisis finibus. Integer enim eros, sagittis sed tincidunt eget, feugiat sed nibh. Cras mattis ultrices varius. Curabitur eget malesuada nisi. Maecenas placerat tortor eget tincidunt blandit. Donec vel fermentum augue. Vivamus nec sollicitudin nibh, vel accumsan eros. Aenean urna lectus, fringilla a urna et, pellentesque rutrum purus. Quisque id rutrum leo. Phasellus et ante id lacus bibendum malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus pharetra ante scelerisque enim rutrum, vehicula dignissim purus vulputate. Aenean metus risus, elementum in mi at, blandit consequat erat. Donec suscipit pulvinar finibus.

            Morbi dignissim, nunc ut tincidunt pulvinar, massa lacus cursus eros, nec mattis diam risus porta est. Quisque eu est facilisis, eleifend tellus vitae, luctus mi. Sed a consectetur tortor, eget vulputate velit. Donec aliquet suscipit ipsum ut bibendum. Maecenas non lacus consectetur, ultricies velit sagittis, efficitur dui. Fusce molestie, risus ut scelerisque bibendum, mi libero faucibus diam, semper tempor felis massa ut nisl. Nunc velit ipsum, ornare ac dolor at, rutrum fermentum lorem. Nulla eu augue in neque viverra ornare a eu magna.

            Pellentesque hendrerit, leo et vulputate condimentum, ante libero sagittis ipsum, quis tincidunt sem dolor a arcu. Cras at volutpat nibh, id mattis elit. Sed in bibendum libero. Suspendisse dolor justo, eleifend sit amet egestas nec, condimentum bibendum turpis. Vestibulum auctor posuere dolor, vel molestie risus tempus ac. Aliquam ut dui justo. Praesent ac tempor nisi. Donec at venenatis felis. Praesent sed tellus felis. Cras vitae metus elementum, sagittis arcu non, luctus arcu. Aliquam non euismod elit. Maecenas malesuada, ligula eu tincidunt blandit, velit justo tristique eros, sit amet aliquet turpis odio vitae turpis. In lectus ipsum, ornare id tincidunt nec, hendrerit suscipit ex. Suspendisse at ligula in mauris lobortis fermentum at vitae ex. Etiam faucibus sem ut lectus laoreet elementum.

            Mauris ac neque id metus euismod sagittis laoreet sit amet erat. Nunc varius elementum sem, non tincidunt ligula porta id. Morbi facilisis velit elit, vel posuere nulla aliquam at. Nullam dapibus risus non mauris vestibulum, eget vestibulum enim luctus. Vestibulum justo justo, rhoncus sit amet condimentum et, eleifend vel mi. Vestibulum enim libero, congue ac dui viverra, sagittis dapibus justo. Aliquam egestas iaculis ante, quis iaculis odio congue eget. Donec pharetra enim quis lacus porta, vitae faucibus ipsum imperdiet. Nullam tristique felis mauris, ac rutrum augue rutrum aliquet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed vitae rhoncus odio. Phasellus gravida sodales arcu et vehicula. Sed augue velit, fringilla a risus sit amet, vulputate scelerisque felis. Suspendisse feugiat erat ipsum, non posuere augue gravida non. Proin tempus id lorem ut elementum.

            Duis imperdiet efficitur est. Ut tincidunt pellentesque tellus, id consectetur nibh maximus a. Nunc at imperdiet ipsum. Proin quam elit, fermentum nec risus efficitur, consequat euismod risus. Nulla facilisi. Ut fermentum urna at arcu sollicitudin ornare nec ac quam. Nunc condimentum mi sit amet nisl tempus rutrum. Phasellus accumsan nisl malesuada purus suscipit pellentesque. Nam sed elit est. Proin dictum felis et lorem luctus aliquam. Maecenas a sagittis arcu. Suspendisse ut augue eleifend, malesuada mi a, sodales dui.

            Nulla at massa non ex tristique tincidunt. Quisque id ipsum sed diam porttitor porta sit amet in diam. Mauris eu lectus massa. Suspendisse in placerat tellus. Donec at ultrices magna. Aenean pulvinar luctus diam, in gravida nunc hendrerit id. In blandit tempor massa, vitae aliquam neque aliquet quis.
        </p>
    </section>

<?php
    $content = ob_get_clean();
    require('menu.php');
?>