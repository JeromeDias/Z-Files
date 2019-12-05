
<?php

$title = "Upload";
include 'header.php';

?>

<form action="" method="post" enctype="multipart/form-data">

<input type="file" id="file" name="file[]" multiple>
<?php

require ('Models/Connexion.php');
if(isset($_POST['submit'])){


    if($success) {
        for($i = 0; $i < sizeof($_FILES['file']['name']); $i++) {
            echo '<br>Nom des fichiers : ' . $_FILES['file']['name'][$i] . '<br>';
        }
    }

}

?>
<input type="submit" id="submit" name="submit">

<p class="error"><?php echo $error; ?></p>
<p class="success"><a href="assets/files/<?php echo $success ?>"download><?php echo $success; ?></a></p>

</form>




<?php

// include 'contact-form.php';

include 'footer.php';
