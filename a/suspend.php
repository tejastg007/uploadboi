<?php
require "./database/dbconfig.php";
$userid = $_GET['id'];
$userdetail = mysqli_fetch_assoc(mysqli_query($conn, "select * from userdata where id='$userid'"));
$username=$userdetail['username']; 
$useremail=$userdetail['email'];
$result = mysqli_query($conn, "select * from filedata where user='$username'");
while ($row = mysqli_fetch_assoc($result)) {
    $filecode = $row['code'];
    $ext = $row['extension'];
    $filetodelete = "../files/" . $filecode . "." . $ext;
    $deletedfiles = mysqli_fetch_assoc(mysqli_query($conn, "select deletedfiles from deletefiles"));
    $deletedfiles = $deletedfiles['deletedfiles'];
    $deletedfiles = $deletedfiles + 1;
    mysqli_query($conn, "update deletefiles set deletedfiles='$deletedfiles'");

    unlink($filetodelete);
}

$to = $useremail;
$subject = "Hello $username, attention!! ";
$header = "Content-Type:text/html; charset=ISO-8859-1\r\n";
$msg = "<p>Hello $username,<br>it is observed that multiple inappropriate files have been uploaded from your account which are against our policies. So, we have decided to suspend your account. <br> Keep in mind that you cannot use your exisiting email id again to sign up on the uploadBoi. <br>Have a great day ahead!<br><b>Best regards,<br>Admin, uploadBoi </b> </p>";
mail($to, $subject, $msg, $header);

mysqli_query($conn, "delete from userdata where id='$userid'");
mysqli_query($conn, "delete from filedata where user='$username'");
header("location:./users");
