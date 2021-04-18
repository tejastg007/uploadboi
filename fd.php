<?php
require "./database/dbconfig.php";
if (!empty($_GET['d'])) {
    $code = $_GET['d'];
    $query = "select * from filedata where code='$code'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $filename = $row['filename'];
    $filesize = $row['size'];
    $uploadedby = $row['user'];
    $uploaddate = $row['uploaddate'];
    $expirydate = $row['expirydate'];
    $hits = $row['hits'];
    $fileinfo = $_SERVER['PHP_SELF'];
    $pathinfo = pathinfo($fileinfo);
    $folder = $pathinfo['dirname'];
    $hits++;
    $filelink = "./files/" . $row['code'] . "." . $row['extension'];
    $updatequery = "update filedata set hits='$hits' where code='$code'";
    if (file_exists($filelink)) {
        header("Cache-Control:public");
        header("Content-Description: File Transfer");
        header("Content-Disposition:attachment; filename=$filename");
        header("Content-Type:application/zip"); 
        header("Content-transfer-encoding:binary");
        readfile($filelink);
        exit();
    }
}
