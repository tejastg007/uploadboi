<?php
require "./dbconfig.php";

if (!isset($_POST['submit'])) {
    header("location:../");
} else {
   
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
    if($filesize<0.1){
        $filesize=0.1;
    }
    $filename = $pathinfo['basename'];
    $extension = $pathinfo['extension'];
    
    $dir = "../files/";
    $newfilename = $code . "." . $extension;
    $uploaddate = $currentDate;
    $expirydate = date('Y-m-d', strtotime($currentDate . '+ 28 days'));
    $hits = 0;
    $query = "insert into filedata(code,filename,extension,size,uploaddate,expirydate,hits,tomail,status) values('$code','$filename','$extension','$filesize','$uploaddate','$expirydate','$hits','$tomail','public')";
    $fileinfo=$_SERVER['PHP_SELF'];
    $pathinfo=pathinfo($fileinfo);
    // print_r($pathinfo);
    $folder=$pathinfo['dirname'];
    echo $protocol . "://" . $domain .$folder. "/f/$code";

    // if(move_uploaded_file($file['tmp_name'],$dir.$newfilename)){
    //     mysqli_query($conn,$query);
    //     $_SESSION['file-link']= $protocol . "://" . $domain .$folder. "/f/$code";
    //     header("location:../");
    // }


}
