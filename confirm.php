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

        <!-- Confirmation message -->
        <div class="row">
            <div class="col-12 text-center">
                <div class="alert alert-warning">
                    Souhaitez-vous vraiment supprimer cette note ? <br> 
                    <strong><?php echo htmlspecialchars($note['title']); ?></strong>
                </div>
                <div>
                    <a href="index.php?page=view&file=<?php echo urlencode($noteFile); ?>" class="btn btn-outline-success">Annuler</a>
                    <a href="delete.php?file=<?php echo urlencode($noteFile); ?>" class="btn btn-outline-danger">Confirmer</a>
                </div>
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
