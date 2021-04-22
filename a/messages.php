<?php
include "./includes/header.php";
if (isset($_POST['send-message'])) {
    $message = $_POST['message'];
    mysqli_query($conn, "insert into broadcast(message,date) values('$message','$currentDate')");
}
if (isset($_POST['send-mail'])) {
    $id=$_POST['id'];
    $to = $_POST['email'];
    $sub = $_POST['subject'];
    $username = $_POST['username'];
    $reply = $_POST['reply'];
    $query = $_POST['message'];
    $subject = "Hello " . $username . "! $sub";
    $header = "Content-Type:text/html; charset=ISO-8859-1\r\n";
    $msg = "<p>$reply</p>";
    mysqli_query($conn, "update messages set status='solved' where id='$id'");
    mail($to, $subject, $msg, $header);
    header("location:./messages");
}
?>

<body>

    <div class="container">
        <?php include "./includes/left.php"  ?>

        <div class="right">
            <div class="title"><b>Hello, </b>admin</div>
            <div class="body-container">
                <div class="messages page">

                    <div class="send-message msg-box">
                        <p class="title">send notification</p>

                        <?php
                        if (empty($_GET['email'])) {
                        ?>
                            <form action="" method="post">
                                <p>message</p>
                                <textarea name="message" rows="4"></textarea>
                                <input type="submit" name="send-message" value="send notification">
                            </form>
                        <?php } else { ?>

                            <form action="" method="post">
                                <input type="text" name="id" value="<?php echo $_GET['id'] ?>" hidden>
                                <input type="text" name="username" value="<?php echo $_GET['username'] ?>" hidden>
                                <p>subject</p>
                                <input type="text" name="subject">
                                <p>email</p>
                                <input type="text" name="email" value="<?php echo $_GET['email'] ?>" readonly>
                                <p>Query</p>
                                <textarea name="message" rows="2"><?php echo $_GET['message'] ?></textarea>
                                <p>Reply</p>
                                <textarea name="reply" rows="2"></textarea>
                                <input type="submit" name="send-mail" value="send mail">
                            </form>
                        <?php } ?>
                    </div>


                    <div class="users-messages msg-box">
                        <p class="title">users query</p>
                        <div class="query-container">

                            <?php
                            $result = mysqli_query($conn, "select * from messages order by id desc");
                            while ($row = mysqli_fetch_assoc($result)) {
                                $email = $row['email'];
                                $message = $row['message'];
                                $username = $row['username'];
                                $id=$row['id'];
                            ?>
                                <div class="query">
                                    <p class="query-text"><?php echo $message ?></p>
                                    <p class="query-info"><?php echo '@' . $username . " " ?>
                                        <?php if ($row['status'] == 'unsolved') { ?>
                                            <a href="./messages?<?php echo 'email=' . $email . "&message=" . $message . "&username=" . $username . "&id=" . $id ?>">Reply</a> <?php } ?>
                                    </p>
                                </div>

                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script>
        document.getElementsByClassName('menu-item')[3].style.color = "rgb(0, 250, 0)";
    </script>
</body>

</html>