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
      <div class="white-box-heading">
            <a href="<?php echo BASE_URL; ?>?s=0" class=" pull-left"><i class="btn btn-success fa fa-home"></i></a>
				Step:<?php echo $_SESSION['step'] . ' ' . $msg; ?>  </div>
