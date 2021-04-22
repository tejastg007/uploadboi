<?php
include "./includes/header.php";
$query1 = "select * from filedata";
$query2 = "select * from filedata where user=''";
$result1 = mysqli_query($conn, $query1);
$result2 = mysqli_query($conn, $query2);
?>

<body>

    <div class="container">
        <?php include "./includes/left.php"  ?>

        <div class="right">
            <div class="title"><b>Hello, </b>admin</div>
            <div class="body-container">
                <div class="page files">
                    <div class="button-container">
                        <button class="tab" id="defaultopen" onclick="opentable(event,'logged')">Logged in users files</button>
                        <button class="tab" onclick="opentable(event,'non-logged')">Non-logged in users files</button>
                    </div>
                    <div class="files-container">
                        <div class="tabcontent" id="logged">
                            <table class="logged-files files-table">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>User</th>
                                        <th>File name</th>
                                        <th>Size MB</th>
                                        <th>Date</th>
                                        <th class="action">view</th>
                                        <th class="action">Download</th>
                                        <th class="action">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        if ($row['user'] != "") {
                                            $username = $row['user'];
                                            $userid = mysqli_fetch_assoc(mysqli_query($conn, "select id from userdata where username='$username'"));
                                            $userid = $userid['id'];
                                            $i++;
                                    ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><a href="./userinfo?id=<?php echo $userid ?>" target="_blank"><?php echo "@" . $row['user'] ?></a> </td>
                                                <td><?php echo $row['filename'] ?></td>
                                                <td><?php echo $row['size'] ?></td>
                                                <td><?php echo $row['uploaddate'] ?></td>
                                                <td class="action" onclick="window.open('./viewfile<?php echo '?id=' . $row['code'] . '&action=view' ?>')"><i class="fas fa-eye"></i></td>

                                                <td class="action" onclick="window.open('./viewfile<?php echo '?id=' . $row['code'] . '&action=download' ?>')"><i class="fas fa-download"></i></td>

                                                <td class="action" onclick="window.open('./deletefile?id=<?php echo $row['code'] ?>','_self')"><i class="fas fa-trash-alt">
                                                    </i></td>
                                            </tr>

                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tabcontent" id="non-logged">
                            <table class="non-logged-files files-table">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>File name</th>
                                        <th>Size MB</th>
                                        <th>Date</th>
                                        <th class="action">view</th>
                                        <th class="action">Download</th>
                                        <th class="action">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($result2)) {
                                            $i++;
                                    ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row['filename'] ?></td>
                                                <td><?php echo $row['size'] ?></td>
                                                <td><?php echo $row['uploaddate'] ?></td>
                                                <td class="action" onclick="window.open('./viewfile<?php echo '?id=' . $row['code'] . '&action=view' ?>')"><i class="fas fa-eye"></i></td>

                                                <td class="action" onclick="window.open('./viewfile<?php echo '?id=' . $row['code'] . '&action=download' ?>')"><i class="fas fa-download"></i></td>

                                                <td class="action" onclick="window.open('./deletefile?id=<?php echo $row['code'] ?>','_self')"><i class="fas fa-trash-alt">
                                                    </i></td>
                                            </tr>
                                    <?php 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.getElementsByClassName('menu-item')[2].style.color = "rgb(0, 250, 0)";

        function opentable(e, tablename) {
            var i, tabcontent, tab;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none"
            }
            tab = document.getElementsByClassName("tab");
            for (i = 0; i < tab.length; i++) {
                tab[i].className = tab[i].className.replace(" active", "");
            }
            document.getElementById(tablename).style.display = "block";
            e.currentTarget.className += " active";
        }
        document.getElementById("defaultopen").click();
    </script>
</body>

</html>