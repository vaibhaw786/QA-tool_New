<?php require_once __DIR__ . '/functions.php'; ?>
<?php include "./include/head.php"; ?>
<body>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <a href="https://thelocallighthouse.com/">
                        <img src="assets/images/logo.png"/></a>
                </div>
                <div class="col-md-3 text-right">
                    <?php
                    if (isset($_SESSION['userinfo'])) {
                        echo '<a style="margin-top: 30px;padding: 10px 10px;" class="btn btn-default" href="index.php?logout=true"><i class="fa fa-sign-out"></i></a>';
                    }
                    ?>
                </div>
            </div>


            <div class="clearfix"></div>
        </div>
    </div>
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1440 126" style="enable-background:new 0 0 1440 126;" xml:space="preserve">
        <path class="st0" d="M685.6,38.8C418.7-11.1,170.2,9.9,0,30v96h1440V30C1252.7,52.2,1010,99.4,685.6,38.8z"></path>
    </svg>
    <div class="bottom-part-box">
        <div class="container">

            <?php
            $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            $GMB = google_auth_callback();
            $accounts = $GMB->accounts;

            if (isset($_POST['accountid'])) {
                $_SESSION['accountid'] = $_POST['accountid'];
            }
            if (isset($_POST['lacationid'])) {
                $_SESSION['lacationid'] = $_POST['lacationid'];
            }

            if (isset($_SESSION['accountid']) && !isset($_SESSION['lacationid'])) {
                $accountid = $_SESSION['accountid'];
                $accountsList = $accounts->get($accountid);
                $locations = $accounts->get($accountid . '/locations');
                $c = count($locations['locations']);
                if ($c > 0) {
                    $_SESSION['step'] = 1;
                    include "./include/steps.php";
                    include './include/accountBusiness.php';
                }
            }
            if (isset($_SESSION['lacationid'])) {
                $_SESSION['step'] = 2;
                if (isset($_REQUEST['s'])) {
                    $_SESSION['step'] = $_REQUEST['s'];
                }
                $lacationid = $_SESSION['lacationid'];
                $location = $accounts->get($lacationid);
                include "./include/steps.php";
                include 'include/headerwhitebox.php';
                if ($_SESSION['step'] == 2) {
                    include 'include/Location.php';
                    #include 'include/test.php';
                    $_SESSION["upcsv"] = 1;
                }
                if ($_SESSION['step'] == 3) {
                    include 'include/uploadcsv.php';
                }
                if ($_SESSION['step'] == 4) {
                    include 'include/Showcsv.php';
                }
                include 'include/footerwhitebox.php';


                //include 'include/create_post.php';
                // r_print($location);
            } elseif (!isset($_SESSION['accountid']) && !isset($_SESSION['lacationid'])) {
                $_SESSION['step'] = 1;
                include "./include/steps.php";
                include "./include/multiaccount.php";
            }
            //r_print($_SESSION);
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="footer-box">
        <div class="copy-reight"> Copyright © 2019 The Local Light House | All Rights Reserved</div>
    </div>
    <svg version="1.1" id="Layer_12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1440 126" style="enable-background:new 0 0 1440 126;" xml:space="preserve">
        <path class="st0" d="M685.6,38.8C418.7-11.1,170.2,9.9,0,30v96h1440V30C1252.7,52.2,1010,99.4,685.6,38.8z"></path>
    </svg>
</div>
<?php include './include/footerscript.php'; ?>
