<?php

require('Models/Download.php');
require('Models/Upload.php');

if(isset($_GET['url'])) {
    $url = $_GET['url'];
}

$upload = getUpload($url);

require('Views/DownloadView.php');