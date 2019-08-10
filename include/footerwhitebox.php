<?php
if($_SESSION['step']<=2){
?>
<div class="btn-green">
    <a href="<?php echo BASE_URL; ?>/?s=<?php echo $_SESSION['step']+1; ?>">Next</a>
</div>
<?php } ?>
</div>
