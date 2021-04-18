<?php
require "./dbconfig.php";
$id=$_SESSION['id'];
$password=mysqli_real_escape_string($conn,$_POST['current-password']);
$newpassword=mysqli_real_escape_string($conn,$_POST['new-password']);
$query="select * from userdata where id='$id' and password='$password'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==1){
    $query="update userdata set password='$newpassword' where id='$id'";
    mysqli_query($conn,$query);
    header("location:../?m=password+changed+sucessfully");
}else{
    header("location:../?m=wrong+password");
}

?>