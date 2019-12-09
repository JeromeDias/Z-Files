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
                    <p>Date : <?php $upload['date']; ?></p><br>
                    <p>Nom des fichiers : <?php
                            for ($i = 0; $i < sizeof($_FILES['file']['name']); $i++) {
                                echo $_FILES['file']['name'][$i] . ', ';
                            }?></p><br>
                    <p>Taille du zip : <?php echo $size; ?></p>
                    <hr>
                    <p>Message de l'expéditeur :</p><br>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem in fugit repudiandae, nihil itaque cumque ex porro a, tempore eius fugiat expedita? Cupiditate veritatis sapiente nulla, molestiae aut nesciunt hic.</p>
                    </p>
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
