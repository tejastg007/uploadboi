<?php
include "./includes/header.php";

?>


<div class="container">
    <div id="toast"><?php echo $message . "!!"; ?></div>

    <div class="upload">
        <div class="upload-title">upload file</div>

        <form id="uploadform" action="./database/uploadfile.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file" onchange="fun1(this.files[0])">
            <label title="max upload size is <?php echo $maxfilesize." MB" ?>" id="filelabel" for="file" class="fas fa-file-upload"></label>

            <div class="after-upload">

                <p id="filenamelabel"></p>
                <button class="far fa-window-close cancel" type="button" onclick="window.open('./upload.php','_self')"></button>

                <progress id="pbar" min="0" max="100" value="0"></progress>

                <div id="warning"></div>

                <div id="optionspanel" class="optionspanel">
                    <select name="status" id="status">
                        <option value="public" selected>public</option>
                        <option value="private">private</option>
                    </select>
                    <input type="email" name="to-mail" placeholder="enter recipient's email (optional)">
                </div>
                <div class="form-options">
                    <button id="togglebutton" type="button" class="options" onclick="optionpanel('optionspanel')">options</button>

                    <input class="options" type="submit" name="submit" value="upload">

                </div>
            </div>
        </form>




        <script>
            /////////set the name of file to the label/////
            function fun1(val) {
                var filesize = val.size;
                filesize = (val.size / (1024 * 1024)).toFixed(2);
                if (filesize < 0.1) {
                    filesize = 0.1;
                }
                if (filesize > <?php echo $maxfilesize ?>) {
                    var x = document.getElementById("toast");
                    x.className = "show";
                    x.innerHTML = "max upload size is <?php echo $maxfilesize ?> MB";
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                    }, 3000);
                } else {
                    var filename = val.name;
                    if (filename.length > 50) {
                        filename = filename.slice(0, 50) + ("...");
                    }

                    document.getElementById("filenamelabel").innerHTML = filename + " (" + filesize + "MB )";
                    if (val != "") {
                        document.querySelector(".after-upload").style.display = "block";
                        document.getElementById("filelabel").style.display = "none";
                    }
                }
            }
            /////////set the name of file to the label ends/////


            ///////progresss bar animation //////////////
            const form = document.getElementById("uploadform");

            form.addEventListener("submit", checksubmit)

            function checksubmit(e) {
                // document.querySelector(".cancel").style.display="none"
                document.getElementById("pbar").style.display = "inline-block"

                var file = document.getElementById("file").files[0];
                const xhr = new XMLHttpRequest();
                xhr.open("POST", '');
                xhr.upload.addEventListener("progress", e => {
                    var percent = e.lengthComputable ? (e.loaded / e.total) * 100 : 0;
                    document.getElementById("pbar").value = percent.toFixed(2)

                })

                // xhr.setRequestHeader("Content-type","multipart/form-data")
                xhr.send(new FormData(form))
            }
            ////////////progress bar animation ends


            ///// toggle additional options panel ////
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("optionspanel").style.display = "none";
            })

            function optionpanel(optionspanel) {
                var e = document.getElementById("optionspanel");
                if (e.style.display === 'none') {
                    e.style.display = 'block'
                } else {

                    e.style.display = 'none'
                }
            }
            ///////toggle additional optins panel end
        </script>
    </div>
</div>


<script>
    document.querySelector('.menu-items > a:nth-child(2)').style.boxShadow = "0px 4px 1px -2px white";
</script>

</body>

</html>