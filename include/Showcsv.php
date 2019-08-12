<?php
if (isset($_SESSION["ShowCSV"]) && $_SESSION["ShowCSV"] == 1) {
    $target_dir = "assets/uploads/" . session_id() . '/';
    $target_file = $target_dir . (session_id() . '.csv');
    $file = fopen($target_file, "r");
    echo '<div class="overflow"><table class="table">';
    $i=0;
    while (!feof($file)) {
        echo '<tr>';
        $col='td';
        if($i==0)
        {
            $col='th';
        }
        $FileData=(fgetcsv($file));
        $j=0;
        foreach ($FileData as $v)
        {
            echo '<'.$col.'>'.$v.'</'.$col.'>';
        $j++;

        }
        echo '</tr>';

        $i++;

    }
    echo '</table></div>';
    fclose($file);
}
?><br><br>
<div class="results"><div class="col-xs-12"></div></div>
<center><a class="btn btn-primary">Now synchronize <i class="fa fa-refresh"></i></a></center>
