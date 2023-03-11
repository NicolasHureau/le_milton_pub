<?php
    ob_start();
?>
    <section class="container d-flex flex-column align-items-center justify-content-center">
        <p class="text-center my-3">
            Le Milon Pub recrute toute l'année...
        </p>
        <form method="post" action="index.php?page=recrut">
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
                    <label for="birthday">Votre date de naissance :</label>
                </div>
                <div class="col">
                    <input type="date" name="birthday" class="form-control" id="birthday" required>
                </div>
            </div>
            <div class="row text-end align-items-center g-3 mb-3">
                <div class="col">
                    <label for="secu">Numéro de Sécurité Social :</label>
                </div>
                <div class="col">
                    <input type="text" name="secu" class="form-control" id="secu" min="0" required>
                </div>
            </div>
            <p><u><strong>Contact :</strong></u></p>
            <div class="row">
                <input type="text" name="adress" class="form-control mb-2" placeholder="Adresse" required>
            </div>
            <div class="row justify-content-center g-3 mb-2">
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
            <div class="row mb-2">
                <select name="job" class="form-select" aria-label="Salle / Cuisine">
                    <option selected>Salle / Cuisine</option>
                    <option value="1">Salle (service)</option>
                    <option value="2">Salle (bar)</option>
                    <option value="3">Cuisine (Chef)</option>
                    <option value="4">Cuisine (Cuisinnier)</option>
                    <option value="5">Cuisine (Commis/Plongeur)</option>
                </select>
            </div>
            <div class="row mb-3">
                <textarea name="motivation" id="motivation" cols="10" rows="5" placeholder="Vos motivations..." required></textarea>
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