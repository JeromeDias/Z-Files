<?php

require('Models/Download.php');

if(isset($_GET['url'])) {
    $id = $_GET['url'];
}

$url = getUpload($id);

require('Views/DownloadView.php');