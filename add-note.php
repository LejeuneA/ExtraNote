<?php
// *******************************************************
// --                    CONTROLLER                     --
// *******************************************************
require 'conf.php';
require 'app/fcts-tools.php';
require 'app/fcts-html.php';
require 'app/fcts-app.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'addnote') {
    // Get form data
    $title = $_POST['title_note'];
    $content = $_POST['content_note'];
    $type = $_POST['type_note'];
    $favoris = isset($_POST['favori_note']) ? 1 : 0;

    // Add new note
    $result = ADDNewNoteToFile($title, $content, $type, $favoris);

    if ($result !== false) {
        // Note added successfully, redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        // Error adding note
        echo "Failed to add the note.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<?php echo HTMLInsertHeader(); ?>

<body>
    <div class="container">
        <!-- Banner -->
        <?php echo HTMLInsertBanner(); ?>

        <!-- Menu -->
        <?php echo HTMLInsertMenu(); ?>

        <div class="row">
            <div class="col-12">
                <h1 class="mb-3 appMainColor appPageTitle">Nouvelle note</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form id="form_add_note" action="add-note.php" method="post">
                    <div class="mb-3 form-group">
                        <label for="title_note" class="form-label appLabel">Titre</label>
                        <input type="text" class="form-control" name="title_note" id="title_note" placeholder="Title" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="type_note" class="form-label appLabel">Type</label>
                        <select name="type_note" id="type_note" class="form-control" required>
                            <option value="note">Note textuelle</option>
                            <option value="code">Code Source</option>
                            <option value="lien">Lien / Url</option>
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <input class="form-check-input" type="checkbox" value="1" id="favori_note" name="favori_note">
                        <label class="form-check-label" for="favori_note">Ajouter aux favoris</label>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="content_note" class="form-label appLabel" id="label_content_note">Contenu</label>
                        <textarea name="content_note" id="content_note" class="form-control" placeholder="Content" rows="10" required></textarea>
                    </div>
                    <input type="hidden" name="action" value="addnote">
                    <button type="submit" class="btn btn-outline-success">Ajouter</button>
                    <a href="index.php" class="btn btn-outline-danger">Annuler</a>
                </form>
            </div>
        </div>

    </div><!-- container -->

    <!-- Footer -->
    <?php echo HTMLInsertFooter(); ?>

    <!-- Scripts -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>