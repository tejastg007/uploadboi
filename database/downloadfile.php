<?php
require "./dbconfig.php";
if (!empty($_GET['c'])) {
    $code = $_GET['c'];
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
    $onclicklink = $protocol . "://" . $domain . $folder . "/f/" . $code . "/download";
    $hits++;
    $filelink = "/files/" . $row['code'] . "." . $row['extension'];
    $updatequery = "update filedata set hits='$hits' where code='$code'";
    $root = $_SERVER['DOCUMENT_ROOT'];
    $fl = $root . $folder . $filelink;
    $file = "../files/" . $code . "." . $row['extension'];
    echo $fl;
    if (file_exists($file)) {
        header("Cache-Control:public");
        header("Content-Description: File Transfer");
        header("Content-Disposition:attachment; filename=$file");
        header("Content-Type:application/zip"); 
        header("Content-transfer-encoding:binary");
        readfile($file);
        exit();
    }
}
