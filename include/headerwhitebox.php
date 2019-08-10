<div class="white-box new-box-select">
      <?php
      $msg = "";
      switch ($_SESSION['step']) {
            case 2:
                  $msg = "Download Example CSV";
                  break;
            case 3:
                  $msg = "Upload CSV";
                  break;
            case 4:
                  $msg = "CSV Confirmation";
                  break;
      }
      ?>
      <div class="white-box-heading">Step:<?php echo $_SESSION['step'] . ' ' . $msg; ?>  </div>
