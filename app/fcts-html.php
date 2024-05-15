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
