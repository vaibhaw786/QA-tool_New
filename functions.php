<?php
if (!session_id()) {
    session_start();
}
define('BASE_URL', 'https://thelocallighthouse.com/GMB_QA');
define('BASE_URI', '/home/content/p3pnexwpnas07_data02/44/42654044/html/GMB_QA/');
if (isset($_REQUEST['s']) && $_REQUEST['s'] == 0) {
    unset($_SESSION['accountid']);
    unset($_SESSION['lacationid']);
}
if (isset($_GET['logout'])) {

    session_destroy();

    header('Location: '.BASE_URL.'/index.php');

    die();
}

function r_print($v, $r = false) {

    echo "<pre>";

    print_r($v);

    echo "</pre>";

    if ($r) {

        die();
    }
}

function google_auth_callback() {

    require_once __DIR__ . '/google-api/vendor/autoload.php';

    require_once __DIR__ . '/mybusiness/MyBusiness.php';

    $redirect_uri = BASE_URL;

    $client_secret = __DIR__ . '/google-api/client_secret4.json';

    $client = new Google_Client();

    $client->setApplicationName("My Business");

    //$client->setDeveloperKey("AIzaSyClCud4WNg3-JCD05zjMGg1QalNn2IFlIk");

    $client->setAuthConfigFile($client_secret);

    $client->addScope(array('https://www.googleapis.com/auth/plus.business.manage', 'https://www.googleapis.com/auth/business.manage'));

    $client->setRedirectUri($redirect_uri);

    $client->setAccessType('offline');

    $client->setApprovalPrompt("force");

    if (isset($_GET['code'])) {

        $accessToken = $client->authenticate($_GET['code']);

        $accessToken = json_encode($accessToken);

        $_SESSION['userinfo'] = $accessToken;

        $redirect = BASE_URL;
        ?>

        <script type="text/javascript">

            window.location.href = '<?php echo $redirect; ?>';

        </script>

        <?php
        die();
    }

    if ($_SESSION['userinfo']) {

        $accessToken1 = $_SESSION['userinfo'];

        $accessToken = json_decode($accessToken1)->access_token;

        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {

            $client->refreshToken(json_decode($accessToken1)->refresh_token);

            $_SESSION['userinfo'] = json_encode($client->getAccessToken());
        }
    } else {

        $authUrl = $client->createAuthUrl();

        header('Location: ' . $authUrl);
        $_SESSION['step']=0;
        $_SESSION["ShowCSV"]=0;
        $_SESSION["upcsv"]=0;
        ?>

        <script type="text/javascript">

            window.location.href = '<?php echo $authUrl; ?>';

        </script>

        <?php
        die();
    }

    $GMB = new Google_Service_Mybusiness($client);

    return $GMB;
}


function deleteDir($dirPath) {
    if (!is_dir($dirPath)) {
        //throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            $file;
            unlink($file);
        }
    }
    rmdir($dirPath);
}
