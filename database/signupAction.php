<?php
require "./dbconfig.php";
if(!isset($_POST['submit'])){
    header("location:../");
}
else{
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    
    $checkusername="select * from userdata where username='$username'";
    $checkusernamer=mysqli_query($conn,$checkusername);
    if(mysqli_num_rows($checkusernamer)>0){
        $_SESSION['signup-error']="username already exist";
        header("location:../signup.php");
    }
    
    $checkemail="select * from userdata where email='$email'";
    $checkemailr=mysqli_query($conn,$checkemail);
    
    if(mysqli_num_rows($checkemailr)>0){
        $_SESSION['signup-error']="email already exist";
        header("location:../signup.php");
    }

    $query="insert into userdata(username,email,password,joindate) values('$username','$email','$password','$currentDate')";
    if(mysqli_query($conn,$query)){
        $_SESSION['signup-success']="success! login now!";
        header("location:../login.php");
    }

}
?>