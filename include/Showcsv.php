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
            if($i>0 && ($j==8 || $j==13 || $j==16))
            {
                $url='assets/uploads/'.session_id().'/'.$v;
                $url1=BASE_URI.'assets/uploads/'.session_id().'/'.$v;
               # echo '<br>file:'.file_exists($url);
                if(!file_exists($url1)){
                    $url='assets/images/noimg.jpg';
                }
                $v='<img style="width:50px" src="'.$url.'">';
            }


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
<center><a class="btn btn-primary">Now synchronize <i class="fa fa-refresh"></i></a></center>
