<?php

$title = "Upload";
include 'header.php';

?>
<section id="upload">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 bordure">
            <div class="form-group row justify-content-center m-2">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="btn-download">
                        <label for="file" class="label-file">
                            <div class="content-download">
                            <img src="assets/img/add-1.svg" alt="Importez vos images">
                            <p class="download-title">Ajoutez vos fichiers</p>
                            </div>
                        </label>
                        <input type="file" id="file" class="input-file" name="file[]" multiple>
                        <p class="error"><?php echo $error; ?></p>
                    </div>

                    <?php

                    require('Models/Connexion.php');
                    if (isset($_POST['submit'])) {

                        if ($success) {
                            echo 'Nom de vos fichiers : ';
                            for ($i = 0; $i < sizeof($_FILES['file']['name']); $i++) {
                                echo $_FILES['file']['name'][$i] . ', ';
                            }
                        }
                    }

                    ?>
            </div>

            <div class="form-group row m-2">
                <label for="emailto">Envoyer à :</label>
                <input type="email" class="form-control" name="emailto" id="emailto" placeholder="Adresse email du destinataire">
                <p class="error"><?php echo $emailtoError ?></p>
            </div>
            <div class="form-group row m-2">
                <label for="email">De la part de :</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Votre adresse email">
                <p class="error"><?php echo $emailError ?></p>
            </div>
            <div class="form-group row m-2">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" cols="50" rows="5" placeholder="Votre message"></textarea>
                <p class="error"><?php echo $messageError ?></p>
            </div>
            <div class="form-group row m-2">
                <input type="submit" id="submit" name="submit" class="form-control btn btn-submit" value="Transférer">
            </div>
        </div>
    </div>
</div>
<p class="success"><a href="assets/files/<?php echo $success ?>" download><?php echo $success; ?></a></p>

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
</div>

</section>

<?php

// include 'contact-form.php';

include 'footer.php';