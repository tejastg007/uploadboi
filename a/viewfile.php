<?php
require "./database/dbconfig.php";
$fileid=$_GET['id'];
$action=$_GET['action'];
$query="select * from filedata where code ='$fileid'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$filename=$row['filename'];
$ext=$row['extension'];
$filelink='../files/'.$fileid.".".$ext;
if($action=="view"){
    if($ext=="pdf"){
        header("Content-Type: application/pdf
        ");
        header("Content-Disposition: inline; filename=$filelink");
        readfile($filelink);
        exit();
    }
    else if($ext=="jpg" || $ext=="jpeg" || $ext=="png" || $ext=="gif"){
        header("location:$filelink");
        exit();
    }
    else{
        header("Cache-Control:public");
        header("Content-Description: File Transfer");
        header("Content-Disposition:inline; filename=$filename");
        header("Content-Type:application/zip"); 
        header("Content-transfer-encoding:binary");
        readfile($filelink);
        exit();
    }
}
else if($action== "download"){
    if (file_exists($filelink)) {
        mysqli_query($conn,$updatequery);
        header("Cache-Control:public");
        header("Content-Description: File Transfer");
        header("Content-Disposition:inline; filename=$filename");
        header("Content-Type:application/zip"); 
        header("Content-transfer-encoding:binary");
        readfile($filelink);
        exit();
    }    
}else{
    header("location:./");
}
?>