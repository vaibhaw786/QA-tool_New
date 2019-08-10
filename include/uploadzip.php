<center>
    <form class="zipupload"  method="post" enctype="multipart/form-data">
        Select File(zip):
        <input class="form-control" type="file" name="fileToUpload"/>
        <br><br><input class="btn btn-success" type="submit" value="Upload Images" name="submit"/>
    </form>
</center>


<?php
if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Upload Images') {
    $target_dir = "assets/uploads/";
    $target_file = $target_dir . basename(session_id() . '.zip');
    $uploadOk = 1;
    unlink($target_file);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != 'zip') {
        echo "<br>Sorry, Please Upload Only Zip Files.";
        $uploadOk = 0;
    }// Check if file already exists
    if (file_exists($target_file)) {
        echo "<br>Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<br>Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            ZipOpener($target_file, $target_dir);
        } else {
            echo "<br>Sorry, there was an error uploading your file.";
        }
    }
}

function ZipOpener($target_file, $target_dir) {
    $zip = new ZipArchive;
    if ($zip->open($target_file) === TRUE) {
        $loc = $target_dir . session_id();
        deleteDir($loc);
        mkdir($loc);
        $zip->extractTo($loc);
        $zip->close();
        unlink($loc . '.zip');
        $_SESSION["upcsv"] = 1;
        ?><script>
        window.location.href="https://thelocallighthouse.com/Post-and-Q-A-tool/?s=4";
        </script>
            <?php
    } else {
        echo 'failed';
    }
}


?>



