<?php
include "./includes/header.php";
$result = mysqli_query($conn, "select * from broadcast order by id desc");

?>

<body>

    <div class="container">
        <?php include "./includes/left.php"  ?>

        <div class="right">
            <div class="title"><b>Hello, </b>admin</div>
            <div class="body-container">
                <div class="notifications page">
                    <div class="notification-container">
                        <p class="notification-title">notifications sent</p>
                        <div class="notification-holder">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <div class="notification">
                                    <p class="notification-text"><?php echo $row['message'] ?></p>
                                    <p class="notification-date"><?php echo $row['date'] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.getElementsByClassName('menu-item')[4].style.color = "rgb(0, 250, 0)";
    </script>
</body>

</html>