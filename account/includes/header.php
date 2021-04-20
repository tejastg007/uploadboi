<?php
require "./database/dbconfig.php";
if (!isset($_SESSION['id'])) {
    header("location:../");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css.css">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Document</title>
</head>

<body>
    <div class="menu">
        <div class="logo">
            <h1><a href="index.php">uploadBoi</a></h1>
        </div>
        <div class="menu-items">
            <a href="./index.php">my account</a>
            <a href="./upload.php">upload files</a>
            <a href="./myfiles.php">my files</a>
            <a href="./messages.php">messages</a>
            <a href="./contact.php">contact us</a>
            <a href="./logout.php">logout</a>
        </div>
    </div>