<?php

$title = "Home";
include 'header.php';

?>

<div class="container">

    <div class="row">

        <div class="col-md-12">
            <!-- <div class="formulaire"> -->

            <form action="" method="post" enctype="multipart/form-data" class="mx-auto">
                <label for="file" class="label-file">
                    <p>Z</p>
                </label>
                <input id="file" class="input-file" type="file">

            </form>
            <div class="popup mx-auto">
                <span>Sélectionnez vos fichiers</span>
            </div>
            <!-- </div> -->

        </div>



    </div>
    <div id="background" class="container">
        <div class=row>
            <div class="col-md-12">
                <img src="assets/img/logo/test.jpg" class="img-fluid" alt="image">
            </div>
        </div>
    </div>

</div>
<?php


include 'footer.php';
