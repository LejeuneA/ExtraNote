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
function displayHeadSection($title = APP_NAME)
{

    $head = '
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        <link rel="preconnect" href="https://fonts.gstatic.com">   
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/2.0.0/modern-normalize.min.css" integrity="sha512-4xo8blKMVCiXpTaLzQSLSw3KFOVPWhm/TRtuPVc4WG6kUgjH6J03IBuG7JZPkcWMxJ5huwaBpOpnwYElP/m6wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
        <link rel="stylesheet" href="/styles.css">
        
        <title>' . $title . '</title>
    ';

    echo $head;
}