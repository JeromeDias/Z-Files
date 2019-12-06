
<?php

$title = "Upload";
include 'header.php';

?>

<form action="" id ="download" method="post" enctype="multipart/form-data" alt="download">

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
<br>
<!--Background part Upload-->
<div id="background" class="container">
        <div class=row>
            <div class="col-md-12">
                <img src="assets/img/download.jpg" class="img-fluid" alt="image">
            </div>
        </div>
    </div>


<?php

// include 'contact-form.php';

include 'footer.php';
