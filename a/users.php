<?php
include "./includes/header.php";
if (!isset($_POST['submit'])) {
    $result = mysqli_query($conn, "select * from userdata");
} else {
    $name = $_POST['search-by-name'];
    if(!empty($name))
    $result = mysqli_query($conn, "select * from userdata where username like '%$name%'");
    else
    $result = mysqli_query($conn, "select * from userdata");
}
?>

<body>

    <div class="container">
        <?php include "./includes/left.php"  ?>

        <div class="right">
            <div class="title"><b>Hello, </b>admin</div>
            <div class="body-container">
                <div class="users page">
                    <form class="search-form" action="" method="POST">
                        <div class="search-name">
                            <input type="text" name="search-by-name" placeholder="Enter name ....." size="50">
                            <input type="submit" value="SEARCH" name="submit">
                        </div>
                    </form>
                    <div class="table-container">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>sr</th>
                                    <th>username</th>
                                    <th>email id</th>
                                    <th>total files</th>
                                    <th>view</th>
                                    <th>suspend</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                $i=0;
                                while($row=mysqli_fetch_assoc($result)){
                                    $i++;
                                    $user=$row['username'];
                                    $totalfiles=mysqli_num_rows(mysqli_query($conn,"select * from filedata where user='$user'"));

                                     ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $totalfiles ?></td>
                                    <td><button onclick="window.open('./userinfo?id=<?php echo $row['id'] ?>','_self')">view</button></td>
                                    <td onclick="window.open('./suspend?id=<?php echo $row['id'] ?>','_self')"><i class="fas fa-user-slash"></i></td>
                                </tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.getElementsByClassName('menu-item')[1].style.color = "rgb(0, 250, 0)";
    </script>
</body>

</html>