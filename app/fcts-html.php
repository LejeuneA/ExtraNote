<?php

/**
 * ******************************************************************
 *          Fonctions dáffichage de  l'interface Utilisateur
 * ******************************************************************
 */



/**
 * Affichage de la section head d'une page
 * 
 * @param string $title 
 * @return void 
 */
function HTMLInsertHeader($title = APP_NAME)
{

    $head = '
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/tooltip.css">
        
        <title>' . $title . '</title>
    ';

    echo $head;
}


/**
 * Affichage de la section banner
 * 
 * 
 * @return void 
 */
function HTMLInsertBanner()
{

    $banner = '<!-- Banner -->
    <div class="row">
            <div class="col-12 text-center">      
            <h1><img src="assets/img/banner.png" class="img-fluid" alt="Logo Extra Note">ExtraNote</h1>
            </div>
        </div>        
    ';

    echo $banner;
}


/**
 * Affichage de la navigation
 * 
 * @return void 
 */
function HTMLInsertMenu()
{

    $navigation = '

        <div class="row">
        <div class="col-12 text-center">      
        x <a href="index.php">Home</a> X <a href="add-note.php?page=addnote">Ajouter</a> x
        </div>
        </div>        <hr>        
        ';

    echo $navigation;
}



/**
 * Affichage du footer
 * 
 * @param string $app_name 
 * @param string $app_version 
 * @param string $app_update 
 * @param string $app_author 
 * @return void 
 */
function HTMLInsertFooter($app_name = APP_NAME, $app_version = APP_VERSION, $app_update = APP_DATE_UPDATE, $app_title = APP_TITLE)
{
    echo <<<HTML
    <footer class="appFooter">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <hr>
                    <p class="infoFooter">$app_name - $app_version - $app_update by $app_title</p>
                </div>
            </div>
        </div>
    </footer>
    HTML;
}

/**
 * HTML for displaying a list of all notes.
 * 
 * This function generates HTML markup to display a list of notes,
 * including their titles, types, dates, and links to view each note.
 * 
 * @param array $sortedNotes An array containing sorted notes data.
 * @return void
 */
function HTMLDisplayNotes($sortedNotes)
{
?>
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
<?php
}


/**
 * HTML for sorting and searching notes.
 * 
 * This function generates HTML markup for sorting and searching notes,
 * including dropdown menus for sorting by date, title, type, and favoris,
 * and a search input field.
 * 
 * @param string $sortTerm The term to sort by (e.g., 'date', 'title', 'type', 'favoris').
 * @param string $sortOrder The sort order ('asc' for ascending, 'desc' for descending).
 * @param string $searchTerm The search term entered by the user.
 * @return void
 */
function HTMLSortNotes($sortTerm, $sortOrder, $searchTerm)
{
?>
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
<?php
}


/**
 * Generates HTML markup to display a list of favorite notes.
 *
 * This function generates HTML markup to display a list of favorite notes,
 * including their titles, types, and links to view each note.
 *
 * @param array $favoritedNotes An array containing data of favorited notes.
 * @return void
 */
function HTMLDisplayFavoriteNotes($favoritedNotes)
{
?>
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
<?php
}



/**
 * HTML for displaying a note.
 * 
 * This function generates HTML markup to display a note's details,
 * including its title, type, date, content, and buttons for editing and deleting.
 * 
 * @param array $note The note data array containing title, type, date, and content.
 * @param string $noteFile The file name of the note.
 * @return void
 */
function HTMLViewNote($note, $noteFile)
{
?>
    <div class="col-4 appViewNote">
        <h1 class="mb-3 appMainColor appPageTitle"><?php echo htmlspecialchars($note['title']); ?></h1>
        <hr>
        <h6 class="mb-3 appMainColor"><span class=""><span class="badge"><?php echo htmlspecialchars($note['type']); ?></span></h6>
        <h6 class="mb-3 appMainColor"><span class=""><?php echo htmlspecialchars($note['date']); ?></span></h6>
        <a href="edit-note.php?page=editnote&file=<?php echo urlencode($noteFile); ?>" class="btn btn-outline-success btn-sm btn-note-delete" title="Modifier">Modifier</a>

        <!-- Link to delete confirmation page -->
        <a href="confirm.php?file=<?php echo urlencode($noteFile); ?>" class="btn btn-outline-danger btn-sm btn-note-delete" title="Supprimer">Supprimer</a>
    </div>
    <div class="col-1"></div>
    <div class="col-7 appViewNote">
        <div>
            <?php echo nl2br(htmlspecialchars($note['content'])); ?>
        </div>
    </div>
<?php
}


/**
 * Adds a new note.
 * 
 * This function is responsible for adding a new note to the system.
 * 
 * @param string $noteType The type of the note (e.g., 'text', 'code', 'link').
 * @return void
 */
function HTMLAddNewNoteForm()
{
    echo '
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
    </form>';
}


/**
 * Generates HTML markup for editing a note.
 *
 * This function generates HTML markup for editing a note, including a form
 * with fields for title, type, favoris, and content. It also handles displaying
 * success or error messages if provided.
 *
 * @param array $note The note data array containing title, type, favoris, and content.
 * @param string $noteFile The file name of the note.
 * @param string|null $successMessage Optional. The success message to display.
 * @param string|null $errorMessage Optional. The error message to display.
 * @return void
 */
function HTMLEditNote($note, $noteFile, $successMessage = null, $errorMessage = null)
{
?>
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3 appMainColor appPageTitle">Modifier la note</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php if (isset($successMessage)) displaySuccessMessage($successMessage); ?>
            <?php if (isset($errorMessage)) echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>'; ?>
            <!-- Edit Note Form -->
            <form id="form_edit_note" action="edit-note.php" method="post">
                <div class="mb-3 form-group">
                    <label for="title_note" class="form-label appLabel">Titre</label>
                    <input type="text" class="form-control" name="title_note" id="title_note" value="<?php echo htmlspecialchars($note['title']); ?>" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="type_note" class="form-label appLabel">Type</label>
                    <select name="type_note" id="type_note" class="form-control" required>
                        <option value="note" <?php echo ($note['type'] === 'note') ? 'selected' : ''; ?>>Note textuelle</option>
                        <option value="code" <?php echo ($note['type'] === 'code') ? 'selected' : ''; ?>>Code Source</option>
                        <option value="lien" <?php echo ($note['type'] === 'lien') ? 'selected' : ''; ?>>Lien / Url</option>
                    </select>
                </div>
                <div class="mb-3 form-group">
                    <input class="form-check-input" type="checkbox" value="1" id="favori_note" name="favori_note" <?php echo ($note['favoris'] == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="favori_note">Ajouter aux favoris</label>
                </div>
                <div class="mb-3 form-group">
                    <label for="content_note" class="form-label appLabel">Contenu</label>
                    <textarea name="content_note" id="content_note" class="form-control" rows="10" required><?php echo htmlspecialchars($note['content']); ?></textarea>
                </div>
                <!-- Hidden fields to pass note data -->
                <input type="hidden" name="action" value="recordnote">
                <input type="hidden" name="file_note" value="<?php echo htmlspecialchars($noteFile); ?>">
                <input type="hidden" name="date_note" value="<?php echo htmlspecialchars($note['date']); ?>">
                <!-- Submit and cancel buttons -->
                <button type="submit" class="btn btn-outline-success">Modifier</button>
                <a href="index.php?file=<?php echo urlencode($noteFile); ?>" class="btn btn-outline-danger">Annuler</a>
            </form>
        </div>
    </div>
<?php
}
