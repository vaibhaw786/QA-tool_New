<?php if (isset($_SESSION["upcsv"]) && $_SESSION["upcsv"] == 1) { ?>
<center><form  class="zipupload" method="post" enctype="multipart/form-data">
        Select File(csv):
        <input class="form-control" type="file" name="fileToCSV"/>
        <br><br><input class="btn btn-success" type="submit" value="Upload CSV" name="uploadsubmit" />
    </form></center>
    <?php
    if (isset($_REQUEST['uploadsubmit'])) {
        
        $target_dir = "assets/uploads/" . session_id() . '/';
        $imageFileType = strtolower(pathinfo($target_dir . $_FILES["fileToCSV"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . basename(session_id() . '.' . $imageFileType);
        $uploadOk = 1;
        unlink($target_file);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != 'csv') {
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
            if (move_uploaded_file($_FILES["fileToCSV"]["tmp_name"], $target_file)) {
                echo 'upsdata'.$_SESSION["ShowCSV"]=1; 
                ?><script>
        window.location.href="https://thelocallighthouse.com/Post-and-Q-A-tool/?s=5";
        </script>
            <?php
            } else {
                echo "<br>Sorry, there was an error uploading your file.";
            }
        }
    } else {
       
    }
}
?>