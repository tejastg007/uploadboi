<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['id'])) {
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
        .error {
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

            <form action="./database/signupAction.php" method="POST" id="signup" onsubmit="return validate()">
                <h1>SignUp </h1>
                <?php
                if (isset($_SESSION['signup-error'])) {
                    echo "<p class='error'>" . $_SESSION['signup-error'] . "</p>";
                    session_unset();
                    session_destroy();
                }
                ?>
                <p>username</p>
                <input type="text" name="username" required autofocus>
                <p>Email Id</p>
                <p style="color:green">password will be sent to email</p>
                <input type="email" name="email" required>
                <input type="submit" name="submit">
            </form>

        </div>

    </div>

    <script>
        function validate() {
            var email = document.getElementsByName('email')[0];
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (re.test(email.value) == false) {
                email.value=""
                email.style.border="1px solid red";
                email.placeholder="enter valid email";
                return false
            } else {
                return true
            }

        }
    </script>

</body>

</html>