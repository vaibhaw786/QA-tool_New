<?php
$accountid = $_SESSION['lacationid'];
$locationid = '2780566215002870102';
$x=$accountid.'/locations/'.$locationid.'/localPosts';
$args ='{
  "languageCode": "en-US",
  "summary": "Snv Developer PRODUCT WPOPPO",
  "callToAction": {
	  "actionType": "SHOP",
	  "url": "https://snvdev.website"
	},
  "product": {
    "productName": "SNV WPOPPO",
    "lowerPrice": {
      "currencyCode": "USD",
      "units": "1",
      "nanos": "0"
    },
    "upperPrice": {
      "currencyCode": "USD",
      "units": "10",
      "nanos": "0"
    }
  },
  "media": [
    {
      "mediaFormat": "PHOTO",
      "sourceUrl":"https://snvservices.com/img/home_bgimg001.png"
    }
  ],
  "topicType": "PRODUCT"
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
// $localPosts = $accounts->create($locations, json_decode($args, true));
// r_print($localPosts);
/*
  "event": {
    "title": "Snv Developer Event",
    "schedule": {
      "startDate": {
          "year": "2019",
          "month": "8",
          "day": "18"
      },
      "startTime": {
          "hours": "04",
          "minutes": "04",
          "seconds": "04",
          "nanos": "04"
      },
      "endDate": {
          "year": "2019",
          "month": "8",
          "day": "19"
      },
      "endTime": {
          "hours": "04",
          "minutes": "04",
          "seconds": "04",
          "nanos": "04"
      }
    }
  },
  "offer": {
    "couponCode": "Snv Offer",
    "redeemOnlineUrl": "https://snvdev.website/offer",
    "termsConditions": "Just for test"
  },
  */

