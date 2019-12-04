<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION, PATHINFO_FILENAME, PATHINFO_DIRNAME, PATHINFO_BASENAME));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Le fichier et correct" . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas correct";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    echo "Désoler, votre fichier existe déja";
    $uploadOk = 0;
}
// tailles des fichiers.
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Désoler, votre fichier et trop volumineux";
    $uploadOk = 0;
}
//formats des fichiers (images).
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {

//error 1 - (Formats).
    echo "Désoler, Votre ficher n'est pas du bon forrmat";
    $uploadOk = 0;
}

if ($uploadOk == 0) {

// error 2 - (Uploads).
    echo "Désoler, votre fichier n'a pas était uploader";

} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {

// erro 3 - (Fichiers non Correct).
        echo "Désoler, votre fichier n'est pas correct";
    }
}
?>