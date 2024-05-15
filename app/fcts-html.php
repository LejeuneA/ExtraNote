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
 * Adds a new note.
 * 
 * This function is responsible for adding a new note to the system.
 * 
 * @param string $noteType The type of the note (e.g., 'text', 'code', 'link').
 * @return void
 */
function HTMLAddNewNoteForm() {
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