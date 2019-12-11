<?php

$title = "Download";
include 'header.php';
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 bordure">
            <div class="form-group row justify-content-center m-2">
                <form action="" method="post" enctype="multipart/form-data">
                    <p class="dwn-title">Page de téléchargement</p>
                    <hr>
                    <p>Date : <?php echo $upload['date']; ?></p><br>
                    <p>Nom des fichiers : 
                    <?php
                    foreach ($img as $value) {
                        echo '<br>' . $value['name'];
                    }
                    ?>
                    </p><br>
                    <p>Taille du zip : <?php echo $upload['poids'] . ' Ko'; ?></p>
                    <hr>
                    <p>Message de l'expéditeur :</p> <?php echo $upload['message']; ?>
                    <hr>
                    <p>Cliquez sur le lien ci dessous pour récuperer vos fichiers</p>
                    <div class="arrowdwn">
                        <a href="https://upload.johnnylemesle.fr/assets/files/<?php echo $upload['url'] ?>">
                            <img class="imgdwn" src="assets/img/download.gif" alt="download">
                        </a>
                    </div>


            </div>
        </div>
    </div>
</div>


<?php
include 'footer.php';
