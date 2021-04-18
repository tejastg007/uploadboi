<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['id'])){
    header("location:./account");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>uploadBoi - signup</title>
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

            <form action="./database/signupAction.php" method="POST" id="signup">
                <h1>SignUp </h1>
                <?php
                if (isset($_SESSION['signup-error'])){
                    echo "<p class='error'>".$_SESSION['signup-error']."</p>";
                    session_unset();
                    session_destroy();
                }
                ?>
                <p>username</p>
                <input type="text" name="username" required autofocus>
                <p>Email Id</p>
                <input type="email" name="email" required>
                <p>Password</p>
                <input type="password" name="password" required>
                <p>Confirm Password</p>
                <input type="password" name="cpassword" required>
                <a href="login.php">Already registed? Login Here</a>
                <input type="submit" name="submit">
            </form>

        </div>

    </div>


</body>

</html>