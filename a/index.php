<?php
include "./includes/header.php";
$totalusers=mysqli_num_rows(mysqli_query($conn,"select * from userdata"));
$totalfiles=mysqli_num_rows(mysqli_query($conn,"select * from filedata"));
$row=mysqli_fetch_assoc(mysqli_query($conn,"select sum(size) from filedata"));
$totalstorage=round($row['sum(size)'],2);
$todayregistered=mysqli_num_rows(mysqli_query($conn,"select * from userdata where joindate='$currentDate'"));
$filestoday=mysqli_num_rows(mysqli_query($conn,"select * from filedata where uploaddate='$currentDate'"));
$frow=mysqli_fetch_assoc(mysqli_query($conn,"select * from deletefiles"));
$deletedfiles=$frow['deletedfiles'];
?>

<body>

    <div class="container">
        <?php include "./includes/left.php"  ?>

        <div class="right ">
            <div class="title"><b>Hello, </b>admin</div>
            <div class="body-container">

                <div class="index page">

                    <div class="cards-container">
                        <div class="card">
                            <div class="card-left">
                                <p>Registered users</p>
                                <h3><?php echo $totalusers; ?></h3>
                            </div>
                            <div class="card-right">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-left">
                                <p>total files uploaded</p>
                                <h3><?php echo $totalfiles ?></h3>
                            </div>
                            <div class="card-right">
                                <i class="fas fa-folder"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-left">
                                <p>storage used MB</p>
                                <h3><?php echo $totalstorage?> </h3>
                            </div>
                            <div class="card-right">
                                <i class="fas fa-database"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-left">
                                <p>registered users today</p>
                                <h3><?php echo $todayregistered?> </h3>
                            </div>
                            <div class="card-right">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-left">
                                <p>files uploded today</p>
                                <h3><?php echo $filestoday?></h3>
                            </div>
                            <div class="card-right">
                                <i class="fas fa-folder"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-left">
                                <p>deleted files</p>
                                <h3><?php echo $deletedfiles ?></h3>
                            </div>
                            <div class="card-right">
                                <i class="fas fa-ban"></i>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>


    <script>
        document.getElementsByClassName('menu-item')[0].style.color = "rgb(0, 250, 0)";
    </script>
</body>

</html>