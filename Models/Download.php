<?php

// Upload d'un fichier

require('Connexion.php');

function getUpload($url) {
    global $bdd;
    $statement = $bdd->prepare('SELECT * FROM files WHERE url = ?');
    $statement->execute(array($url));
    $upload = $statement->fetch();
    return $upload;
}
