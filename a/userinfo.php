<?php
include "./includes/header.php";
if (!isset($_GET['id'])) {
    header("location:./users");
    exit();
}
$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "select * from userdata where id='$id'"));
if($row>0){
$username = $row['username'];
$email = $row['email'];
$joindate = $row['joindate'];
$diskused = mysqli_fetch_assoc(mysqli_query($conn, "select sum(size) from filedata where user='$username'"));
$diskused = round($diskused['sum(size)'],2);
$totalfiles = mysqli_num_rows(mysqli_query($conn, "select * from filedata where user='$username'"));
$hits = mysqli_fetch_assoc(mysqli_query($conn, "select sum(hits) from filedata where user ='$username'"));
$hits = $hits['sum(hits)'];
}
?>

<body>

    <div class="container">
        <?php include "./includes/left.php"  ?>

        <div class="right">
            <div class="title"><b>Hello, </b>admin</div>
            <div class="body-container">
                <div class="user-info page">
                    <div class="toggle-container">
                        <button onclick="opentable(event,'userinfo')" class="tab" id="defaultopen">User info</button>
                        <button onclick="opentable(event,'userfiles')" class="tab" >User files</button>
                    </div>

                    <div class="user-table-container  table-container">

                        <div class=" tabcontent" id="userinfo">
                            <table class="userinfo-table userdetails">

                                <tr>
                                    <td>username</td>
                                    <td>-</td>
                                    <td><?php echo $username ?></td>
                                </tr>
                                <tr>
                                    <td>email id</td>
                                    <td>-</td>
                                    <td><?php echo $email ?></td>
                                </tr>
                                <tr>
                                    <td>joined</td>
                                    <td>-</td>
                                    <td><?php echo $joindate ?></td>
                                </tr>
                                <tr>
                                    <td>total files</td>
                                    <td>-</td>
                                    <td><?php echo $totalfiles ?></td>
                                </tr>
                                <tr>
                                    <td>disk used</td>
                                    <td>-</td>
                                    <td><?php echo $diskused . " MB" ?></td>
                                </tr>
                                <tr>
                                    <td>hits</td>
                                    <td>-</td>
                                    <td><?php echo $hits ?></td>
                                </tr>
                            </table>
                        </div>

                        <?php
                        $query = "select * from filedata where user='$username'";
                        $result = mysqli_query($conn, $query);
                        ?>

                        <div class=" tabcontent" id="userfiles">
                            <table class="userfiles-table userdetails">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>Name</th>
                                        <th>Size MB</th>
                                        <th>Date</th>
                                        <th>Hits</th>
                                        <th>view</th>
                                        <th>Download</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=0;
                                    while ($row=mysqli_fetch_assoc($result)) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row['filename'] ?></td>
                                            <td><?php echo $row['size'] ?></td>
                                            <td><?php echo $row['uploaddate'] ?></td>
                                            <td><?php echo $row['hits'] ?></td>
                                            <td onclick="window.open('./viewfile<?php echo '?id='.$row['code'].'&action=view' ?>')"><i class="fas fa-eye"></i></td>

                                            <td onclick="window.open('./viewfile<?php echo '?id='.$row['code'].'&action=download' ?>')"><i class="fas fa-download"></i></td>

                                            <td onclick="window.open('./deletefile?id=<?php echo $row['code'] ?>')"><i class="fas fa-trash-alt">
                                                </i></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
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