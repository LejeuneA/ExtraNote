<?php
// *******************************************************
// --                    CONTROLLER                     --
// *******************************************************
require 'conf.php';
require 'app/fcts-tools.php';
require 'app/fcts-html.php';
require 'app/fcts-app.php';

// Get all notes
$notes = GETListAllNotes();

// Handle sorting
$sortTerm = $_POST['sort_note'] ?? SORT_BY_DEFAULT;
$sortOrder = $_POST['sort_order'] ?? SORT_ORDER_DEFAULT;
$sortedNotes = GETNotesSortedBy($notes, $sortTerm, $sortOrder);

// Handle searching
$searchTerm = $_POST['search_term'] ?? '';
if (!empty($searchTerm)) {
    $sortedNotes = SEARCHInNotes($sortedNotes, $searchTerm);
}

// Filter favorited notes
$favoritedNotes = array_filter($sortedNotes, function ($note) {
    return $note['favoris'] == 1;
});
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

        <!-- Sort notes -->
        <?php echo HTMLSortNotes($sortTerm, $sortOrder, $searchTerm); ?>

        <!-- Affichage des notes -->
        <?php echo HTMLDisplayNotes($sortedNotes); ?>


        <!-- Affichage des favoris -->
        <hr>
        <?php echo HTMLDisplayFavoriteNotes($favoritedNotes); ?>
        <!-- End of Affichage des favoris -->


    </div><!-- container -->

    <!-- Footer -->
    <?php echo HTMLInsertFooter(); ?>

    <!-- Scripts -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>