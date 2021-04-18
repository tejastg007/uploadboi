<?php
    require "./dbconfig.php";
    if(!isset($_POST['submit'])){
        header("location:../login.php");
    } 
    else{
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        $query="select * from userdata where email='$email' and password='$password'";
        $result=mysqli_query($conn,$query);
        
        if(mysqli_num_rows($result)==1){
            while($row=mysqli_fetch_assoc($result)){
                $userid=$row['id'];
            }
            $_SESSION['id']=$userid;
            header("location:../account/");
        }
        else{
            $_SESSION['login-error']="wrong credentials!";
            header("location:../login.php");
        }
    }
?>