<?php
$accountid = $_REQUEST['lacationid'];
$locationid = '2780566215002870102';
$x=$accountid.'/locations/'.$locationid.'/media';
$args ='{
  "mediaFormat": "PHOTO",
  "locationAssociation": {
    "category":"COVER"
  },
  "description": "Snv new cover photo",
  "sourceUrl": "https://snvservices.com/img/home_bgimg001.png"
}';
r_print(json_decode($args, true));
$userinfo = $_SESSION['userinfo'];
$userinfo = json_decode($userinfo);
$access_token = $userinfo->access_token;
$query = json_decode($args, true);
$request_uri = "https://mybusiness.googleapis.com/v4/$x/?access_token=" . $access_token;
$curinit = curl_init($request_uri);
curl_setopt($curinit, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curinit, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curinit, CURLOPT_POSTFIELDS, json_encode($query));
curl_setopt($curinit, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curinit, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen(json_encode($query)))
);
$json = curl_exec($curinit);
$phpObj = json_decode($json, true);
r_print($json);

