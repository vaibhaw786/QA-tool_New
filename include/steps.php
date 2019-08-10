
<div class="stepsdata">
    <hr>
   <?php for($i=1;$i<=5;$i++){
    $active='';
    $stepclass=$_SESSION['step']; 
    if($i==$stepclass)
    {
        $active=' active btn btn-danger';
    }else{
        $active='btn btn-info';
    }
    ?>
    <span class="steps steps<?php echo $i; echo ' '.$active;?>">Step-<?php echo $i; ?></span>
   <?php } ?>
    <hr>  
</div> 
