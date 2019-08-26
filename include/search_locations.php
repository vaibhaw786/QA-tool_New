<?php
require_once '../functions.php';
$GMB = google_auth_callback();
$accounts = $GMB->accounts;
$accountid = $_SESSION['accountid'];
$v = $_POST['v'];
// $v = urlencode($v);
$locations1 = $accounts->get($accountid.'/locations?pageSize=5&filter=location_name:%22'.$v.'%22');
$res = array();
if($locations1['locations']) {
  $res['locations'] = $locations1['locations'];
  $res['msg'] = 'Success';
  $res['status'] = true;
}
else {
  $res['msg'] = 'No result found!';
  $res['status'] = false;
}
echo json_encode($res);