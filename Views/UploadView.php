
<?php

$title = "Upload";
include 'header.php';

?>
<div class="container">


<form action="" method="post" enctype="multipart/form-data">

<label for="emailto">Envoyer à :</label>
<input type="email" name="emailto" id="emailto">
<p class="error"><?php echo $emailtoError ?></p>
<label for="email">De la part de :</label>
<input type="email" name="email" id="email">
<p class="error"><?php echo $emailError ?></p>
<label for="message">Message</label>
<textarea name="message" id="message" cols="30" rows="10"></textarea>
<p class="error"><?php echo $messageError ?></p>

<input type="file" id="file" name="file[]" multiple>
<?php

require ('Models/Connexion.php');
if(isset($_POST['submit'])){


    if($success) {
        echo 'Nom des fichiers : ';
        for($i = 0; $i < sizeof($_FILES['file']['name']); $i++) {
            echo $_FILES['file']['name'][$i] . ', ';
        }
    }

}

?>
<input type="submit" id="submit" name="submit" value="Envoyer">

<p class="error"><?php echo $error; ?></p>
<p class="success"><a href="assets/files/<?php echo $success ?>"download><?php echo $success; ?></a></p>

</form>
</div>



<?php

// include 'contact-form.php';

include 'footer.php';
