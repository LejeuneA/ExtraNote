<?php
// *******************************************************
// --                    CONTROLLER                     --
// *******************************************************
require 'conf.php';
require 'app/fcts-tools.php';
require 'app/fcts-html.php';
require 'app/fcts-app.php';

$noteFile = $_GET['file'] ?? '';

if (empty($noteFile)) {
    // Handle the case where no note file is provided
    // You can display an error message or redirect the user
    // For example:
    header("Location: index.php");
    exit();
}

$note = LOADNoteFromFile($noteFile);

if (!$note) {
    // Handle the case where the note file doesn't exist or couldn't be loaded
    // For example:
    echo "Note not found!";
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
            <div class="col-4 appViewNote">                    
                <h1 class="mb-3 appMainColor appPageTitle"><?php echo htmlspecialchars($note['title']); ?></h1>  
                <hr>
                <h6 class="mb-3 appMainColor"><span class=""><span class="badge"><?php echo htmlspecialchars($note['type']); ?></span></h6> 
                <h6 class="mb-3 appMainColor"><span class=""><?php echo htmlspecialchars($note['date']); ?></span></h6>
                <a href="index.php?page=editnote&file=<?php echo urlencode($noteFile); ?>" class="btn btn-outline-success btn-sm btn-note-delete" title="Modifier"> Modifier </a>
                <a href="index.php?page=confirm&file=<?php echo urlencode($noteFile); ?>" class="btn btn-outline-danger btn-sm btn-note-delete" title="Supprimer"> Supprimer </a>                    
            </div>   
            <div class="col-1"></div> 
            <div class="col-7 appViewNote">                     
                <div>
                    <?php echo nl2br(htmlspecialchars($note['content'])); ?>
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