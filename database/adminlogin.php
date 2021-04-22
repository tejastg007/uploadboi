<?php
require "./dbconfig.php";
if (!isset($_POST['submit'])) {
    header("location:../admin");
} else {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = "select * from admin where email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['password']) {
            $_SESSION['admin'] = $row['id'];
            header("location:../a/");
        } else {
            $_SESSION['login-error'] = "wrong credentials!";
            header("location:../admin");
        }
    } else {
        $_SESSION['login-error'] = "no email found!!";
        header("location:../admin");
    }
}
