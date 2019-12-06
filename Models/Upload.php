
<?php

// Upload d'un fichier

require('Connexion.php');

$error = "";
$success = "";
$emailtoError = "";
$emailError = "";
$messageError = "";

// Envoi du fichier

if (isset($_POST['submit'])) {

    $emailto = $_POST['emailto'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $isSuccess = true;
    $emailText = "";

    if(empty($emailto)) {
        $emailtoError = "Merci de renseigner un e-mail";
        $isSuccess = false;
    }

    if(empty($email)) {
        $emailError = "Merci de renseigner un e-mail";
        $isSuccess = false;
    }
    else {
        $emailText .= "De la part de : " . $email . '\n';
    }

    if(empty($message)) {
        $messageError = "Merci de renseigner message";
        $isSuccess = false;
    }
    else {
        $emailText .= "Message : " . $message . '\n';
    }

    if (!empty($_FILES['file']['name'][0])) {

        $zip = new ZipArchive();
        $zip_name = getcwd() . "/assets/files/upload_" . time() . ".zip";


        // Créer un fichier ZIP
        if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
            $error .= "La compression n'a pas fonctionné.<br>";
        }

        $imageCount = count($_FILES['file']['name']);
        for ($i = 0; $i < $imageCount; $i++) {
            $ext = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);

            if ($_FILES['file']['tmp_name'][$i] == '') {
                continue;
            }
            // $newname = date('YmdHis', time()) . mt_rand() . '.' . $ext;

            // Ajoute un fichier dans un dossier ZIP
            $zip->addFromString($_FILES['file']['name'][$i], file_get_contents($_FILES['file']['tmp_name'][$i]));

            // Déplace le fichier dans le chemin défini
            // move_uploaded_file($_FILES['file']['tmp_name'][$i], './assets/files/' . $newname);
        }
        $zip->close();

        // Création du lien de téléchargement
        $success = basename($zip_name);
        global $bdd;
        $statement = $bdd->prepare('INSERT INTO files (url) VALUES (?)');
        $statement->execute(array($success));
    } else {
        $error = '<strong>Erreur ! </strong> Merci de choisir un fichier.';
    }
}

// if (isset($_POST['submit'])) {
//     $file = $_FILES['file']['name'][0];
//     $filepath = 'assets/files/';
//     $success = true;
//     $imageCount = count($_FILES['file']['name']);

//     for ($i=0; $i < $imageCount ; $i++) { 
//         if($_FILES['file']['tmp_name'][$i] == ''){
//             continue;
//         }
//         $newname = date('YmdHis', time()) . mt_rand() . '.jpg';
//         move_uploaded_file($_FILES['file']['tmp_name'][$i], $filepath . $newname);
//     }

// }
// Récupération des fichiers dans un tableau
//     foreach ($file as $value) {
//         if (empty($value)) {
//             $error = "Merci de choisir un fichier";
//             $success = false;
//         } else {
//             $success = true;
//         }
//         // Si succès : ajout dans la BDD
//         if ($success) {
//             echo 'Fichier créé: ' . $filepath . $value . '<br>';
//             global $bdd;
//             $statement = $bdd->prepare('INSERT INTO files (url) VALUES (?)');
//             $statement->execute(array($value));
//             $success = "OK !";
//         }
//     }
//     $zip = new ZipArchive();

//     if ($zip->open('Zip.zip', ZipArchive::CREATE) == true) {
//         echo "ouvert";

//         $zip->addFile($filepath.$file);

//         $zip->close();
//     } else {
//         echo "Impossible";
//     }
// }
// Si pas de fichier sélectionné

// Si succès
// if ($success) {
//     global $bdd;
//     // move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
//     $statement = $bdd->prepare('INSERT INTO files (url) VALUES (?)');
//     $statement->execute(array($file));
//     $success = "OK !";
// }














?>