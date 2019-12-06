
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
    $subjectto = "Fichier à télécharger";
    $subject = "Email de confirmation d'envoi";
    $messageto = $_POST['message'];
    $message = "
    Votre mail à bien été envoyé à : ".$emailto. "
    Le lien de téléchargement est :";
    $isSuccess = true;
    $emailText = "";
    $headers = 'MIME-Version: 1.0';
    $headers .= 'Content-type: text/html; charset=iso-8859-1';

    if(empty($emailto)) {
        $emailtoError = "Merci de renseigner un e-mail";
        $isSuccess = false;
    }

    if(empty($email)) {
        $emailError = "Merci de renseigner un e-mail";
        $isSuccess = false;
    }
    else {
        $emailText .= "De la part de : " . $email . "\n";
    }

    if(empty($message)) {
        $messageError = "Merci de renseigner un message";
        $isSuccess = false;
    }
    else {
        $emailText .= "Message : " . $messageto . "\n";
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

        if (!empty($email) && !empty($emailto)) {
            $emailText .= "
            Z-Files - Le transfert de fichiers numéro 1
            Votre lien de téléchargement : ";
            mail($emailto, $subjectto, $emailText, $headers);
            mail($email, $subject, $message, $headers);
        }
    } else {
        $error = '<strong>Erreur ! </strong> Merci de choisir un fichier.';
    }
}