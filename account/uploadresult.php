<?php
error_reporting(0);
include "./includes/header.php";

$code = mysqli_real_escape_string($conn, $_GET['code']);
if ($code == "") {
    header("location:./upload.php");
} else {
    $query = "select * from filedata where code='$code'";
    $result = mysqli_query($conn, $query);
    $fileinfo = $_SERVER['PHP_SELF'];
    $pathinfo = pathinfo($fileinfo);
    $folder = $pathinfo['dirname'];
    $root=rtrim($folder,'/account');
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

?>



            <div class="container">
                <span id="copymsg">link copied!</span>

                <div class="upload-result">
                    <div class="upload-result-title">well done! your file uploaded successfully!</div>

                    <div class="upload-result-container">
                        <div class="left">
                            <div class="filename"><?php echo $row['filename'] ?></div>
                            <div class="filesize"><?php echo $row['size'] . " MB" ?></div>
                            <button onclick="window.open('<?php echo $protocol . "://" . $domain .$root. "/f/$code"  ?>')">download</button>
                        </div>

                        <div class="right">
                           
                            <div class="link-container">
                                <p>download link</p>
                                <input id="download" type="text" value="<?php echo $protocol . "://" . $domain .$root. "/f/$code" ?>" readonly>
                                <button onclick="copydownload()">copy</button>
                            </div>
                            <div class="link-container">
                                <p>html code</p>
                                <input id="html" type="text" value="<?php $link = $protocol . "://" . $domain .$root. "/f/$code";
                                                                    echo "<a href='$link' target='_blank'>Download</a>" ?>" readonly>
                                <button onclick="copyhtml()">copy</button>
                            </div>
                        </div>

                    </div>
            <?php
        }
    } else {
        echo "<div class='upload-result'>";
        echo "<div class='upload-result-title'>ummhmmmm! something went wrong!</div>";
        echo "<a href='./upload.php'>back to upload page</a>";
        echo "</div>";
    }
            ?>
                </div>
            </div>


            <script>
                document.querySelector('.menu-items > a:nth-child(2)').style.boxShadow = "0px 4px 1px -2px white";

                function copydirect() {
                    var text = document.getElementById('direct');
                    text.select();
                    document.execCommand("copy");
                    var x = document.getElementById("copymsg");
                    x.className = "copymsg";
                    setTimeout(function() {
                        x.className = x.className.replace("copymsg", "");
                    }, 3000);
                }

                function copydownload() {
                    var text = document.getElementById('download');
                    text.select();
                    document.execCommand("copy");
                    var x = document.getElementById("copymsg");
                    x.className = "copymsg";
                    setTimeout(function() {
                        x.className = x.className.replace("copymsg", "");
                    }, 3000);
                }

                function copyhtml() {
                    var text = document.getElementById('html');
                    text.select();
                    document.execCommand("copy");
                    var x = document.getElementById("copymsg");
                    x.className = "copymsg";
                    setTimeout(function() {
                        x.className = x.className.replace("copymsg", "");
                    }, 3000);
                }
            </script>

            </body>

            </html>
        <?php
    } ?>