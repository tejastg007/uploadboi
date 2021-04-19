<?php
session_start();
error_reporting(0);
$email=$_GET['m'];
if(isset($_SESSION['id'])){
    header("location:./account");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>uploadBoi - login</title>
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/menu.css">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <style>
        .error{
            color: red;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <div class="container">
    <?php
            require "./includes/menu.php";
        ?>

        <div class="first">
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>

            <form action="./database/loginAction.php" method="POST">
                <h1>login </h1>
                <?php
                if (isset($_SESSION['login-error'])) {
                    echo "<p class='error'>" . $_SESSION['login-error'] . "</p>";
                    session_unset();
                    session_destroy();
                }
                if (isset($_SESSION['signup-success'])) {
                    echo "<p class='error'>" . $_SESSION['signup-success'] . "</p>";
                    session_unset();
                    session_destroy();
                }
                ?>
                <p>email id</p>
                <input type="email" name="email" value="<?php echo $email ?>" required autofocus>
                <p>Password</p>
                <input type="password" name="password" required autofocus>
                <a href="signup.php">Don't have account? create here!</a>
                <input type="submit" name="submit">
            </form>

        </div>

    </div>
</body>

</html>