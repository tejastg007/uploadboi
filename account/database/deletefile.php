<?php
require "./dbconfig.php";
$fileid=mysqli_real_escape_string($conn,$_GET['id']);
$query="select code,extension from filedata where id='$fileid'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$filecode=$row['code'];
$ext=$row['extension'];
$filetodelete='../../files/'.$filecode.".".$ext;
$query="delete from filedata where id='$fileid'";
// echo $filetodelete;

if(mysqli_query($conn,$query)){
    if(unlink($filetodelete)){
        header("location:../myfiles.php");
    }
}
