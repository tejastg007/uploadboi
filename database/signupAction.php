<?php
require "./dbconfig.php";
if (!isset($_POST['submit'])) {
    header("location:../");
} else {
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $email=strtolower($email);
    $blacklistcheck=mysqli_num_rows(mysqli_query($conn,"select * from blacklist where mail='$email'"));
    if($blacklistcheck>0){
        $_SESSION['signup-error']="your email is blacklisted!";
        header("location:../signup.php");
        exit();
    }
    $checkusername = "select * from userdata where username='$username'";
    $checkusernamer = mysqli_query($conn, $checkusername);
    if (mysqli_num_rows($checkusernamer) > 0) {
        $_SESSION['signup-error'] = "username already exist";
        header("location:../signup.php");
        exit();
    }

    $checkemail = "select * from userdata where email='$email'";
    $checkemailr = mysqli_query($conn, $checkemail);

    if (mysqli_num_rows($checkemailr) > 0) {
        $_SESSION['signup-error'] = "email already exist";
        header("location:../signup.php");
        exit();
    }

    
    $password = substr(md5(rand()), 0, 7);;
    $query = "insert into userdata(username,email,password,joindate) values('$username','$email','$password','$currentDate')";
    if (mysqli_query($conn, $query)) {
        $to = $email;
        $subject = "hello $username to uploadboi- get your password";
        $header = "Content-Type:text/html; charset=ISO-8859-1\r\n";
        $msg = "<h4>Hello $username, thank you for registering with uploadBoi! <br><br>Your login details are :<br>username : $username <br> password : <b>$password</b></h4>";
        mail($to, $subject, $msg,$header);
        $_SESSION['signup-success'] = "check INBOX for password, dont forget to check spam folder!";
        header("location:../login.php");
        exit();
    }
}
