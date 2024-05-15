<?php

require 'conf.php';
require 'app/fcts-tools.php';
require 'app/fcts-html.php';
require 'app/fcts-app.php';

$noteFile = $_GET['file'] ?? '';

if (empty($noteFile)) {
    header("Location: index.php");
    exit();
}

$note = LOADNoteFromFile($noteFile);

if (!$note) {
    echo "Note non trouvée!";
    exit();
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

        <!-- Affichage des notes -->
        <div class="row">               
            <?php echo HTMLViewNote($note, $noteFile); ?>
        </div>
    </div><!-- container -->

    <!-- Footer -->
    <?php echo HTMLInsertFooter(); ?>

    <!-- Scripts -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>
