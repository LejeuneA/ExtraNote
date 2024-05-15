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
        <div class="row">
            <div class="col-12">
                <h1 class="mb-3 appMainColor appPageTitle">Notes <img src="assets/img/section.png" alt="section icon"></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <form id="form_sort_note" method="post">
                    <label for="sort_note" class="label_sort_note">Trier par</label>
                    <select name="sort_note" id="sort_note" class="select_sort_note">
                        <option value="date" <?php echo $sortTerm === 'date' ? 'selected' : ''; ?>>Date</option>
                        <option value="title" <?php echo $sortTerm === 'title' ? 'selected' : ''; ?>>Titre</option>
                        <option value="type" <?php echo $sortTerm === 'type' ? 'selected' : ''; ?>>Type</option>
                        <option value="favoris" <?php echo $sortTerm === 'favoris' ? 'selected' : ''; ?>>Favoris</option>
                    </select>
                    <select name="sort_order" id="sort_order" class="select_sort_order">
                        <option value="asc" <?php echo $sortOrder === 'asc' ? 'selected' : ''; ?>>Asc</option>
                        <option value="desc" <?php echo $sortOrder === 'desc' ? 'selected' : ''; ?>>Desc</option>
                    </select>
                </form>
            </div>
            <div class="col-md-9">
                <div class="input_wrapper float-end">
                    <form id="form_search_note" method="post">
                        <input type="hidden" name="action" value="search">
                        <input type="text" name="search_term" id="search_term" class="input_search_note" placeholder="Rechercher une note" value="<?php echo htmlspecialchars($searchTerm); ?>">
                        <button type="submit" class="btn_submit_search" title="Soumettre la recherche">&rarr;</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Affichage des notes -->
        <div class="row">
            <div class="col-12">
                <div>
                    <?php
                    if (!empty($sortedNotes)) {
                        foreach ($sortedNotes as $note) {
                            $isFavoris = $note['favoris'] ? '<img src="assets/img/favorite.png" alt="favoris">' : '';
                            $noteType = htmlspecialchars(NOTE_TYPES[$note['type']]);
                            $noteTitle = htmlspecialchars($note['title']);
                            $noteDate = htmlspecialchars($note['date']);
                            $noteLink = 'view-note.php?file=' . urlencode($note['filename']);
                    ?>
                            <a href="<?php echo $noteLink; ?>" class="appNoteBox">
                                <div class="row tuileNote" alt="Lire">
                                    <div class="col-12">
                                        <?php echo $isFavoris; ?>
                                        <span class="badge text-bg-secondary"><?php echo $noteType; ?></span>
                                        <h2 class="mb-3 appMainColor"><?php echo $noteTitle; ?></h2>
                                        <small><?php echo $noteDate; ?></small>
                                    </div>
                                </div>
                            </a>
                    <?php
                        }
                    } else {
                        echo '<p>Aucune note à afficher.</p>';
                    }
                    ?>

                </div>
            </div>
        </div>

        <!-- Affichage des favoris -->
        <hr>
        <div class="row">
            <div class="col-12">
                <h1 class="mb-3 appMainColor appPageTitle">Favoris <img src="assets/img/section.png" alt="section icon"></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php foreach ($favoritedNotes as $note) : ?>
                    <?php
                    $favoriteNoteLink = 'view-note.php?file=' . urlencode($note['filename']);
                    ?>
                    <a href="<?php echo $favoriteNoteLink; ?>" class="appNoteBox">
                        <div class="row tuileNote-mini" alt="Lire">
                            <div class="col-12">
                                <span class="badge text-bg-secondary"><?php echo $note['type']; ?></span>
                                <h2 class="mb-3 appMainColor"><?php echo $note['title']; ?></h2>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- End of Affichage des favoris -->


    </div><!-- container -->

    <!-- Footer -->
    <?php echo HTMLInsertFooter(); ?>

    <!-- Scripts -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>