<?php
    ob_start();
?>
    <section class="container d-flex flex-column align-items-center justify-content-center flex-grow-1">
        <p class="text-center my-3">
            Nous recrutons toute l'année!<br><br>
            Venez rejoindre une équipe dynamique pour travailler dans la bonne humeur.<br><br>
            Posez votre candidature et nous vous répondrons au plus vite.
        </p>
        <div class="my-5">
            LOGO
        </div>
        <form method="post" action="index.php?page=recrut" enctype="multipart/form-data">
            <div class="row justify-content-center g-3 mb-2">
                <div class="col-auto">
                    <input type="text" name="first_name" class="form-control" placeholder="Prénom" required>
                </div>
                <div class="col-auto">
                    <input type="text" name="last_name" class="form-control" placeholder="Nom" required>
                </div>
            </div>
            <div class="row text-end align-items-center g-3 mb-2">
                <div class="col">
                    <label for="birthday">Date de naissance :</label>
                </div>
                <div class="col">
                    <input type="date" name="birthday" class="form-control" id="birthday" required>
                </div>
            </div>
            <p><u><strong>Contact :</strong></u></p>
            <div>
                <input type="text" name="adress" class="form-control mb-3" placeholder="Adresse" required>
            </div>
            <div class="row justify-content-center g-3 mb-3">
                <div class="col-auto">
                    <input type="text" name="zip_code" class="form-control" placeholder="Code postal" required>
                </div>
                <div class="col-auto">
                    <input type="text" name="city" class="form-control" placeholder="Ville" required>
                </div>
            </div>
            <div class="row justify-content-center g-3 mb-3">
                <div class="col-auto">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-auto">
                    <input type="tel" name="Phone" class="form-control" placeholder="Numéro de téléphone" required>
                </div>
            </div>
            <p><u><strong>Vos aspirations au sein de l'établissement :</strong></u></p>
            <div class="mb-3">
                <select name="job" class="form-select" aria-label="Salle / Cuisine">
                    <option selected>Salle / Cuisine</option>
                    <optgroup label="Salle">
                        <option value="serveur">Serveuse/Serveur</option>
                        <option value="barman">Barmaid/Barman</option>
                    </optgroup>
                    <optgroup label="cuisine">
                        <option value="chef">Chef(fe)</option>
                        <option value="cuisinier">Cuisinnier(e)</option>
                        <option value="commis_plongeur">Commis-Plongeur</option>
                    </optgroup>
                </select>
            </div>
            <div class="mb-3">
                <textarea name="motivation" id="motivation" rows="5" class="w-100" placeholder="Présentez-vous"></textarea>
            </div>
            <div class="text-center my-3">
                <label for="cv" class="form-label">Joindre un C.V. (jpeg ou pdf)</label>
                <input type="file" class="form-control mb-2" name="cv" id="cv">
            </div>
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-success px-5">Envoyer ma candidature</button>
            </div>
        </form>
    </section>
<?php
    $content = ob_get_clean();
    require('menu.php');
?>