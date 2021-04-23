<?php
include "./includes/header.php";

$id = $_SESSION['id'];
$select = "select username from userdata where id='$id'";
$selectquery = mysqli_query($conn, $select);
$show = mysqli_fetch_assoc($selectquery);
$user = $show['username'];

if (isset($_POST['submitsearch'])) {
    $searchstring = $_POST['search'];
    $query = $query = "select * from filedata where user='$user' and filename like '%$searchstring%'";
    $result = mysqli_query($conn, $query);
} else {
    $query = "select * from filedata where user='$user'";
    $result = mysqli_query($conn, $query);
}
$fileinfo = $_SERVER['PHP_SELF'];
$pathinfo = pathinfo($fileinfo);
$folder = $pathinfo['dirname'];
$root = rtrim($folder, '/account');

?>



<div class="container">
    <span id="copymsg">link copied!</span>
    <div class="my-files">

        <form action="" method="post">
            <div class="search">
                <input type="text" name="search" placeholder="search here...." autofocus>
                <input id="sharecopy" type="text" name="sharecopy" placeholder="search here.... ">
                <button type="submit" name="submitsearch">search</button>
            </div>
        </form>
        <div class="files-container">
            <table>
                <thead>
                    <tr>
                        <th>sr</th>
                        <th>filename</th>
                        <th>size(MB)</th>
                        <th>status</th>
                        <th>date</th>
                        <th>expires</th>
                        <th>hits</th>
                        <th>download</th>
                        <th>share</th>
                        <th>delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $i++;
                        $link = $protocol . "://" . $domain .$root. "/f/" . $row['code'];
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['filename'] ?></td>
                            <td><?php echo $row['size'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td><?php echo $row['uploaddate'] ?></td>
                            <td><?php echo $row['expirydate'] ?></td>
                            <td><?php echo $row['hits'] ?></td>
                            <td onclick="window.open('<?php echo $link; ?>')"><i class="fas fa-download"></i></td>
                            <td onclick="sharecopy('<?php echo $link ?>')"><i class="fas fa-share"></i></td>
                            <td onclick="delet(<?php echo $row['id'] ?>)"><i class="fas fa-trash-alt"></i></td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
        <script>

                        function delet(id){
                            if(window.confirm('Are you confirm to delete this file?')){
                                window.location='./database/deletefile.php?id='+id;
                            }
                        }

            function sharecopy(link) {
                var link = link;
                var sharecopy = document.getElementById('sharecopy');
                sharecopy.value = link;
                sharecopy.select();
                document.execCommand('Copy');

                var x = document.getElementById("copymsg");
                x.className = "copymsg";
                setTimeout(function() {
                    x.className = x.className.replace("copymsg", "");
                }, 3000);
            }
        </script>
    </div>
</div>


<script>
    document.querySelector('.menu-items > a:nth-child(3)').style.boxShadow = "0px 4px 1px -2px white";
</script>

</body>

</html>