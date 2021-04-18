<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['id'])) {
    header("location:./account");
} else {
    require "./database/dbconfig.php";
    if (isset($_POST['submit'])) {
        $array = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        do {
            $str = '';
            for ($i = 0; $i < 7; $i++) {
                shuffle($array);
                $random = array_rand($array, 1);
                $str .= $random;
            }
            $checkcode = "select * from filedata where code='$str'";
            $coderesult = mysqli_query($conn, $checkcode);
        } while (mysqli_num_rows($coderesult) > 0);
        $code = $str;
        $tomail = mysqli_real_escape_string($conn, $_POST['email']);
        $file = $_FILES['file1'];
        $pathinfo = pathinfo($file['name']);
        $filesize = round((($file['size']) / (1024 * 1024)), 2);
        if ($filesize < 0.1) {
            $filesize = 0.1;
        }
        $filename = $pathinfo['basename'];
        $extension = $pathinfo['extension'];

        $dir = "./files/";
        $newfilename = $code . "." . $extension;
        $uploaddate = $currentDate;
        $expirydate = date('Y-m-d', strtotime($currentDate . '+ 28 days'));
        $hits = 0;
        $query = "insert into filedata(code,filename,extension,size,uploaddate,expirydate,hits,tomail,status) values('$code','$filename','$extension','$filesize','$uploaddate','$expirydate','$hits','$tomail','public')";
        $fileinfo = $_SERVER['PHP_SELF'];
        $pathinfo = pathinfo($fileinfo);
        $folder = $pathinfo['dirname'];
        $filelink = $protocol . "://" . $domain . $folder . "/f/$code";
        if (move_uploaded_file($file['tmp_name'], $dir . $newfilename)) {
            mysqli_query($conn, $query);
            $_SESSION['file-link'] = $filelink;
            
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome to uploadBoi</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/menu.css">

    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">

        <?php
        require "./includes/menu.php";
        ?>

        <div class="first">
            <span id="copymsg">link copied!</span>
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>

            <div class="info">
                <h1>UploadBoi -!</h1>
                <h2>welcome</h2>
                <h3 class="infoDescription">upload, share and download.... cooooo!!!</h3>
                <p>uploadBoi is an easy way to upload, store and share the files, audios, videos and images.</p>

            </div>

            <div class="form">

                <form id="upload-file" action="./" method="post" enctype="multipart/form-data">
                    <img src="./media/uploadImage.png" alt="">

                    <input onchange="fun1(this.files[0])" type="file" id="file1" name="file1" required>
                    <label for="file1" id="fileLabel">choose file</label>

                    <input id="email" type="email" name="email" placeholder="enter email id (optional)">

                    <progress id="pbar" value="0" min="0" max="100"></progress>

                    <?php
                    if (isset($_SESSION['file-link'])) {
                    ?>
                        <div class="link" id="link">
                            <input type="text" name="link" value="<?php echo $_SESSION['file-link'] ?>" readonly>
                            <button onclick="copyfunction()">copy</button>
                        </div>
                    <?php
                        session_unset();
                        session_destroy();
                    }

                    ?>


                    <input type="submit" value="Upload" name="submit">
                </form>
            </div>

        </div>


    </div>
    <script>
        function fun1(val) {
            var filesize = val.size;
            var filename = val.name;
            if (filename.length > 25) {
                filename = filename.slice(0, 25) + ("...");
            }
            filesize = (val.size / (1024 * 1024)).toFixed(2);
            if (filesize < 0.1) {
                filesize = 0.1;
            }
            document.getElementById("fileLabel").innerHTML = filename + " (" + filesize + "MB )";
            if (val != "") {
                document.getElementById("email").style.display = "inline-block"
            }
        }

        //for progress bar 
        const form = document.getElementById("upload-file");

        form.addEventListener("submit", checksubmit)

        function checksubmit(e) {
            document.getElementById("pbar").style.display = "inline-block"

            var email = document.getElementById("email").value;
            if (email.length == 0) {
                document.getElementById("email").style.display = "none"
            }

            var file = document.getElementById("file1").files[0];
            const xhr = new XMLHttpRequest();
            xhr.open("POST", '');
            xhr.upload.addEventListener("progress", e => {
                var percent = e.lengthComputable ? (e.loaded / e.total) * 100 : 0;
                document.getElementById("pbar").value = percent.toFixed(2)

            })

            // xhr.setRequestHeader("Content-type","multipart/form-data")
            xhr.send(new FormData(form))
        }
        //for pprogress bar ends


        //////////copy link on click///////
        function copyfunction() {
            var text = document.getElementsByName("link")[0];
            text.select();
            document.execCommand("copy");

            var x = document.getElementById("copymsg");
            x.className = "copymsg";
            setTimeout(function() {
                x.className = x.className.replace("copymsg", "");
            }, 3000);
        }
        ///////copy link on click ends/////
    </script>
</body>

</html>