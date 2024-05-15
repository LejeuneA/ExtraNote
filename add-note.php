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
                <?php echo HTMLAddNewNoteForm(); ?>
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