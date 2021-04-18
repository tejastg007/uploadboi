<!DOCTYPE html>
<?php
    require "./database/dbconfig.php";
?>
<html lang="en">

<head>
    <base href="http://localhost:8000/pbl">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>uploadBoi- download file</title>
    <link rel="stylesheet" href="/pbl/css/f.css">
    <link rel="stylesheet" href="/pbl/css/menu.css">
    <link rel="stylesheet" href="/pbl/css/menu2.css">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400&display=swap" rel="stylesheet">
    <style>
        .menu {
            background: linear-gradient(to left, #02aab0, #00cdac);
            position: sticky;
        }
    </style>
</head>

<body>

    <?php

    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $getuser = "select username from userdata where id='$id'";
        $userresult = mysqli_query($conn, $getuser);
        $userrow = mysqli_fetch_assoc($userresult);
        $user = $userrow['username'];

        include "./includes/menu2.php";
    } else {
        include "./includes/menu.php";
    }
    
    if (empty($_GET['id']) && empty($_GET['d'])) {
        header("location:../");
    } else {
        $code = $_GET['id'];

        if (!empty($_GET['id']) && empty($_GET['d'])) {
            $query = "select * from filedata where code='$code'";
            $result = mysqli_query($conn, $query);

    ?>

            <div class="container">


                <div class="file-info-container">
                    <div class="title">File Info</div>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $filename = $row['filename'];
                        $filesize = $row['size'];
                        $uploadedby = $row['user'];
                        $uploaddate = $row['uploaddate'];
                        $expirydate = $row['expirydate'];
                        $fileinfo = $_SERVER['PHP_SELF'];
                        $pathinfo = pathinfo($fileinfo);
                        $folder = $pathinfo['dirname'];
                        $onclicklink = $protocol . "://" . $domain . $folder . "/f/" . $code . "/download";
                        $filelink = "/files/" . $row['code'] . "." . $row['extension'];
                        $root = $_SERVER['DOCUMENT_ROOT'];
                        $fl = $root . $folder . $filelink;
                        if ($row['status'] == 'public' || ($row['status']=='private' && $user==$row['user'])) {
                    ?>
                            <div class="file-info">
                                <div class="field">
                                    <div class="field-name">File Name :</div>
                                    <div class="field-info">&nbsp;<?php echo $filename; ?></div>
                                </div>
                                <div class="field">
                                    <div class="field-name">File size :</div>
                                    <div class="field-info">&nbsp;<?php echo $filesize . " MB"; ?></div>
                                </div>
                                <div class="field">
                                    <div class="field-name">Uploaded by :</div>
                                    <div class="field-info">&nbsp;<?php
                                                                    if (empty($uploadedby)) echo "anonymous";
                                                                    echo $uploadedby; ?></div>
                                </div>
                                <div class="field">
                                    <div class="field-name">Uploaded on:</div>
                                    <div class="field-info">&nbsp;<?php echo $uploaddate; ?></div>
                                </div>
                                <div class="field">
                                    <div class="field-name">Terminate on:</div>
                                    <div class="field-info">&nbsp;<?php echo $expirydate; ?></div>
                                </div>
                                <div class="field">
                                    <button onclick="window.open('./fd/<?php echo $code ?>')">DOWNLOAD</button>
                                </div>
                        <?php
                        } else {
                            echo "<div style='padding:20px;text-align:center;color:red'>the file you are tring to access is private!</div>";
                        }
                    } else {
                        echo "<div style='padding:20px;text-align:center;color:red'>the file you are tring to access may be deleted or never exists!</div>";
                    }
                        ?>
                            </div>


                </div>
            </div>
</body>

</html>
<?php
        } 
    }
?>