<?php

require('Models/Download.php');

if(isset($_GET['url'])) {
    $url = $_GET['url'];
}

$upload = getUpload($url);

require('Views/DownloadView.php');