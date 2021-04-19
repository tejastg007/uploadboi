<?php
include "./includes/header.php";
$message = $_GET['m'];
$id = $_SESSION['id'];
$query = "select * from userdata where id='$id'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $username = $row['username'];
        $email = $row['email'];
    $joindate = $row['joindate'];
}
?>


<div class="container">
    <div id="toast"><?php echo $message."!!"; ?></div>
    <div class="my-account">

        <div class="left">
            <p class="username"><?php echo $username ?></p>
            <p class="email"><?php echo $email ?></p>
            <div class="options">
                <button class="tablink" onclick="panel(event,'overview')" id="defaultopen"><i class="fas fa-home"></i> overview</button>
                <button class="tablink" onclick="panel(event,'settings')"><i class="fas fa-user-circle"></i> account settings</button>

            </div>
        </div>

        <?php
        $checkrow = "select * from filedata where user='$username'";
        $checkrowresult = mysqli_query($conn, $checkrow);
        $totalfiles = mysqli_num_rows($checkrowresult);
        $query = "select sum(size),sum(hits) from filedata where user='$username' group by user";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $spaceused = $row['sum(size)'];
            $spaceused =round($spaceused,2);
            $totaldownloads = $row['sum(hits)'];
        }


        ?>

        <div class="right">
            <p id="popup"><?php echo $message; ?></p>
            <div id="overview" class="overview-panel tabcontent">
                <table class="overview-panel-table">

                    <tr>
                        <td>files uploaded</td>
                        <td><?php echo $totalfiles ?></td>
                    </tr>
                    <tr>
                        <td>space used</td>
                        <td><?php echo $spaceused . " MB of Unlimited" ?></td>
                    </tr>
                    <tr>
                        <td>max upload size</td>
                        <td>1024 MB</td>
                    </tr>
                    <tr>
                        <td>total downloads</td>
                        <td><?php echo $totaldownloads ?></td>
                    </tr>
                    <tr>
                        <td>date joined</td>
                        <td><?php echo $joindate ?></td>
                    </tr>
                </table>
            </div>

            <div id="settings" class="settings-panel tabcontent">
                <form id="updatepassword" onsubmit="return updatepass()" action="./database/updatepassword.php" method="post">
                    <table class="settings-panel-table">
                        <tr>
                            <td>email</td>
                            <td><input type="
                            email" value="<?php echo $email ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>current password</td>
                            <td><input type="password" name="current-password" autofocus required></td>
                        </tr>
                        <tr>
                            <td>new password</td>
                            <td><input type="password" name="new-password" onkeyup="checkpass()" required></td>
                        </tr>
                        <tr>
                            <td>retype password</td>
                            <td><input type="password" name="confirm-password" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="save"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <script>
            document.getElementById("defaultopen").click();

            function panel(e, panelname) {
                var i, tabcontent, tablink;
                tabcontent = document.getElementsByClassName('tabcontent');
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablink = document.getElementsByClassName('tablink');
                for (i = 0; i < tablink.length; i++) {
                    tablink[i].className = tablink[i].className.replace(" active", "");
                }
                document.getElementById(panelname).style.display = "block";
                e.currentTarget.className += " active"
            }
        </script>
    </div>
</div>


<script>
    var message = document.getElementById("popup").innerHTML;
    if (message != "") {
        var x = document.getElementById("toast");
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 3000);
    }

    function updatepass() {
        var pass = document.getElementsByName('new-password')[0].value;
        var cpass = document.getElementsByName('confirm-password')[0].value;
        if (pass != cpass) {
            document.getElementsByName('confirm-password')[0].value = "";
            document.getElementsByName('confirm-password')[0].placeholder = "confirm pass doesnt match!";

            return false;
        }
        return true;

    }
    document.querySelector('.menu-items > a:nth-child(1)').style.boxShadow = "0px 4px 1px -2px white";
</script>

</body>

</html>