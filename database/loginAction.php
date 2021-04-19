<?php
require "./dbconfig.php";
if (!isset($_POST['submit'])) {
    header("location:../login.php");
} else {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = "select * from userdata where email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['password']) {
            $_SESSION['id'] = $row['id'];
            header("location:../account/");
        } else {
            $_SESSION['login-error'] = "wrong credentials!";
            header("location:../login.php?m=$email");
        }
    } else {
        $_SESSION['login-error'] = "no email found!!";
        header("location:../login.php");
    }
}
