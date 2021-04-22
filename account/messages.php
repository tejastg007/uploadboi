<?php
include "./includes/header.php";
$result = mysqli_query($conn, "select * from broadcast order by id desc");
?>


<div class="container">
    <div class="messages">
        <div class="message-box">
            <div class="messages-title">Messages from Admin</div>

            <div class="message-holder">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="message-container">
                        <p class="message"><?php echo $row['message'] ?></p>
                        <p class="date"><?php echo $row['date'] ?> </p>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>
<script>
    document.querySelector('.menu-items > a:nth-child(4)').style.boxShadow = "0px 4px 1px -2px white";
</script>

</body>

</html>