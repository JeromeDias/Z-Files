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
                <p>Date : </p><br>
                <p>Nom des fichiers :</p><br>
                <p>Taille du zip :</p>
                <hr>
                <p>Message de l'expéditeur :</p><br>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem in fugit repudiandae, nihil itaque cumque ex porro a, tempore eius fugiat expedita? Cupiditate veritatis sapiente nulla, molestiae aut nesciunt hic.</p>                </p> 
                <hr>
                <p>Cliquez sur le lien ci dessous pour récuperer vos fichiers</p>
                <div class="arrowdwn">
                    <img class="imgdwn" src="assets/img/download.gif" alt="download">
                </div>
                <div class="form-group row m-2">
                <input type="submit" id="submit" name="submit" class="form-control btn btn-submit" value="Télécharger le fichier">
                </div>

            </div>
        </div>
    </div>
</div>


        <?php
        include 'footer.php';
