<?php
$accountid = $_REQUEST['lacationid'];
$locationid = '2780566215002870102';
$x=$accountid.'/locations/'.$locationid.'/localPosts';
$args ='{
  "languageCode": "en-US",
  "summary": "Best development and seo company",
  "callToAction": {
      "actionType": "LEARN_MORE",
      "url": "https://snvservices.com"
    },
  "media": [
    {
      "mediaFormat": "PHOTO",
      "sourceUrl":"https://snvservices.com/img/home_bgimg001.png"
    }
  ],
  "topicType": "STANDARD"
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
