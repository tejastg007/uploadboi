<?php
include "./includes/header.php";
$id=$_SESSION['id'];
$mail=mysqli_fetch_assoc(mysqli_query($conn,"select * from userdata where id='$id'"));
$mail=$mail['email'];
$username=$mail['username'];
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    mysqli_query($conn,"insert into messages(username,name,message,email,date,status) values ('$username','$name','$message','$email','$currentDate','unsolved')");

    $to = $email;
    $subject = "Hello, $name, greetings from uploadboi!!! ";
    $header = "Content-Type:text/html; charset=ISO-8859-1\r\n";
    $msg = "<p>Hello, we have received your query. The team will look into it and solve it as soon as possible!<br>Till then, enjoy our free services!<br><b>Best regards,<br>Admin, upoloadBoi</b></p>";
    mail($to, $subject, $msg, $header);
}
?>


<div class="container">
    <div class="contact">
        
        <div class="contact-form-container">
            <h3>Contact </h3>
            <form action="" class="contact-form" method="post">
                <p>Name</p>
                <input type="text" name="name"> 
                <p>Email</p>
                <input type="text" name="email" value="<?php echo $mail?>" readonly >
                <p>Message</p>
                <textarea name="message" rows="5" onkeydown=" validate()"></textarea>
                <p id="warning">max limit is 200 words</p>
                <input type="submit" name="submit" >
            </form>
        </div>
    </div>

</div>
<script>
    document.querySelector('.menu-items > a:nth-child(5)').style.boxShadow = "0px 4px 1px -2px white";

    function validate(){
        var msg=document.getElementsByName('message')[0];
        if(msg.value.length>200){
            msg.value=msg.value.slice(0,200);
            document.getElementsByTagName('textarea')[0].style.border="1px solid red"
            document.getElementById('warning').style.display="block"
        }
        if(msg.value.length<200){
            document.getElementsByTagName('textarea')[0].style.border="1px solid rgb(185, 185, 185)"
            document.getElementById('warning').style.display="none"
        }
    }
</script>

</body>

</html>