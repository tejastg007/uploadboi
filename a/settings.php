<?php
include "./includes/header.php";
if (isset($_POST['submit'])) {
    $maxlogged = $_POST['maxuploadsize-logged'];
    $maxnologged = $_POST['maxuploadsize-no-logged'];
    $query = "update settings set maxfilesize='$maxlogged', maxfilesizenl='$maxnologged'";
    mysqli_query($conn, $query);
    $message="Max file upload size has been changed to $maxlogged MB for the logged in users and $maxnologged MB for non-logged in users.";
    mysqli_query($conn,"insert into broadcast(message,date) values('$message','$currentDate')");
}
$row = mysqli_fetch_assoc(mysqli_query($conn, "select * from settings"));

?>

<body>

    <div class="container">
        <?php include "./includes/left.php"  ?>

        <div class="right">
            <div class="title"><b>Hello, </b>admin</div>
            <div class="body-container">
                <div class="settings page">
                    <form action="" method="post" class="settings-form">
                        <h3>UploadBoi Settings</h3>
                        <p>Max file size for non logged in users (MB)</p>

                        <input type="number" name="maxuploadsize-no-logged" value="<?php echo $row['maxfilesizenl'] ?>"><br>
                        <p>Max file size for non logged in users (MB)</p>

                        <input type="number" name="maxuploadsize-logged" value="<?php echo $row['maxfilesize'] ?>">
                        <input type="submit" name="submit">
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.getElementsByClassName('menu-item')[5].style.color = "rgb(0, 250, 0)";
    </script>
</body>

</html>