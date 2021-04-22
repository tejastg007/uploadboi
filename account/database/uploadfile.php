<?php
require "./dbconfig.php";

if (!isset($_POST['submit'])) {
    header("location:../");
} else {
    $id = $_SESSION['id'];
    $username = "select username from userdata where id='$id'";
    $usernameresult = mysqli_query($conn, $username);
    while ($show = mysqli_fetch_assoc($usernameresult)) {
        $username = $show['username'];
    }
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
    $tomail = mysqli_real_escape_string($conn, $_POST['to-mail']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $file = $_FILES['file'];
    $pathinfo = pathinfo($file['name']);
    $filesize = round((($file['size']) / (1024 * 1024)), 2);
    if ($filesize < 0.1) {
        $filesize = 0.1;
    }
    $filename = $pathinfo['basename'];
    $extension = $pathinfo['extension'];
    $code = $str;
    $dir = "../../files/";
    $newfilename = $code . "." . $extension;
    $uploaddate = $currentDate;
    $expirydate = date('Y-m-d', strtotime($currentDate . '+ 365 days'));
    $hits = 0;
    $query = "insert into filedata(code,filename,extension,size,uploaddate,expirydate,hits,tomail,status,user) values('$code','$filename','$extension','$filesize','$uploaddate','$expirydate','$hits','$tomail','$status','$username')";


    if (move_uploaded_file($file['tmp_name'], $dir . $newfilename)) {
        mysqli_query($conn, $query);
        if (!empty($tomail)) {
            $filelink=$protocol."://".$domain."/pbl/f/".$code;
            $signup=$protocol."://".$domain."/pbl/signup";
            $to = $tomail;
            $subject = "Hello, you got something!!! ";
            $header = "Content-Type:text/html; charset=ISO-8859-1\r\n";
            $msg = "<p>Hello, greetings from uploadBoi!<br>Here is your file - <a href='$filelink'>Download</a><br><br>Signup on uploadBoi for more features!<br><a href='$signup'> <b>SIGNUP</b></a></p>";
            mail($to, $subject, $msg, $header);
        }
        header("location:../uploadresult.php?code=$code");
    }
}
