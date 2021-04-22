<?php
require "./database/dbconfig.php";
$fileid=$_GET['id'];
$result=mysqli_query($conn,"select * from filedata where code='$fileid'");
$row=mysqli_fetch_assoc($result);
$ext=$row['extension'];
$username=$row['user'];
$filename=$row['filename'];
$usermail=mysqli_fetch_assoc(mysqli_query($conn,"select email from userdata where username='$username'"));
$usermail=$usermail['email'];
$filetodelete='../files/'.$fileid.".".$ext;
$delquery="delete from filedata where code='$fileid'";
if(mysqli_query($conn,$delquery)){
    $row=mysqli_fetch_assoc(mysqli_query($conn,"select deletedfiles from deletefiles"));
    $deletedfiles=$row['deletedfiles'];
    $deletedfiles=$deletedfiles+1;
    mysqli_query($conn,"update deletefiles set deletedfiles='$deletedfiles'");
    unlink($filetodelete);

    if(!empty($username)){
    $to = $usermail;
    $subject = "hello $username, attention!! ";
    $header = "Content-Type:text/html; charset=ISO-8859-1\r\n";
    $msg = "<p>Hello $username, we have seen some inappropriate content you have uploaded from your dashboard which is strictly opposite to our policies. <br>to keep our server clean, we are deleting the file named as $filename. <br> If such content found again, your account will be permanantly disabled.<br><br>Keep using uploadBoi!! <br><b>Best regards<br>Admin, uploadboi</b> </p>";
    mail($to, $subject, $msg,$header);
    }
    header("location:./files");
    exit();
}
