<?php

$title = "Upload";
include 'header.php';

?>
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-6 bordure">
            <div class="form-group row justify-content-center m-2">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="file" class="label-file">
                        <p>Z</p>
                    </label>
                    <input type="file" id="file" class="input-file" name="file[]" multiple>
                    <?php

                    require('Models/Connexion.php');
                    if (isset($_POST['submit'])) {


                        if ($success) {
                            echo 'Nom des fichiers : ';
                            for ($i = 0; $i < sizeof($_FILES['file']['name']); $i++) {
                                echo $_FILES['file']['name'][$i] . ', ';
                            }
                        }
                    }

                    ?>
            </div>
            <div class="form-group row m-2">
                <label for="emailto">Envoyer à :</label>
                <input type="email" class="form-control" name="emailto" id="emailto">
            </div>
            <div class="form-group row m-2">
                <label for="email">De la part de :</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group row m-2">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" cols="50" rows="3"></textarea>
            </div>
            <div class="form-group row m-2">
                <input type="submit" id="submit" name="submit" class="form-control btn btn-outline-info" value="Envoyer">
            </div>
        </div>
    </div>
</div>
<p class="error"><?php echo $error; ?></p>
<p class="success"><a href="assets/files/<?php echo $success ?>" download><?php echo $success; ?></a></p>

</form>
</div>



<?php

// include 'contact-form.php';

include 'footer.php';
