<?php

// Upload d'un fichier

require('Connexion.php');

function getUpload($id) {
    global $bdd;
    $statement = $bdd->prepare('SELECT * FROM files WHERE id = ?');
    $statement->execute(array($id));
    $upload = $statement->fetch();
    return $upload;
}