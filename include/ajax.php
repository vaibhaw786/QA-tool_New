<?php
require_once '../functions.php';

if (isset($_POST["action"]) && $_POST["action"] == 'upload') {
    $target_dir = BASE_URI."assets/uploads/" . session_id() . '/';
    $target_file = $target_dir . (session_id() . '.csv');
    $file = fopen($target_file, "r");
    $i=0;
    while (!feof($file)) {
        $FileData=(fgetcsv($file));
        if($i) {
            $accountid = $_SESSION['accountid'];
            $BusinessID = $FileData[0];
            $BusinessID = base64_decode($BusinessID);
            $x = $accountid.'/locations/'.$BusinessID.'/localPosts';
            $userinfo = $_SESSION['userinfo'];
            $userinfo = json_decode($userinfo);
            $access_token = $userinfo->access_token;
            $request_uri = "https://mybusiness.googleapis.com/v4/$x/?access_token=" . $access_token;

            // event object data
            if(!empty($FileData[2])) {
                $EventName = $FileData[2];
                $EventStartDate = explode('-', $FileData[3]);
                $EventEndDate =  explode('-', $FileData[4]);
                $EventStartTime =  explode(':', $FileData[5]);
                $EventEndTime = explode(':', $FileData[6]);
                $EventUrl = $FileData[7];
                $EventImage = $FileData[8];
                $EventImg=BASE_URL.'/assets/uploads/'.session_id().'/'.$EventImage;
                $url1=BASE_URI.'assets/uploads/'.session_id().'/'.$EventImage;
                if(!file_exists($url1)){
                    $EventImg=BASE_URL.'/assets/images/noimg.jpg';
                }
                $args ='{
                      "languageCode": "en-US",
                      "summary": "'.$EventName.'",
                      "callToAction": {
                          "actionType": "BOOK",
                          "url": "'.$EventUrl.'"
                      },
                      "event": {
                        "title": "'.$EventName.'",
                        "schedule": {
                          "startDate": {
                              "year": "'.$EventStartDate[2].'",
                              "month": "'.$EventStartDate[1].'",
                              "day": "'.$EventStartDate[0].'"
                          },
                          "startTime": {
                              "hours": "'.$EventStartTime[0].'",
                              "minutes": "'.$EventStartTime[1].'",
                              "seconds": "'.$EventStartTime[2].'",
                              "nanos": "00"
                          },
                          "endDate": {
                              "year": "'.$EventEndDate[2].'",
                              "month": "'.$EventEndDate[1].'",
                              "day": "'.$EventEndDate[0].'"
                          },
                          "endTime": {
                              "hours": "'.$EventEndTime[0].'",
                              "minutes": "'.$EventEndTime[1].'",
                              "seconds": "'.$EventEndTime[2].'",
                              "nanos": "00"
                          }
                        }
                      },
                      "media": [
                        {
                          "mediaFormat": "PHOTO",
                          "sourceUrl":"'.$EventImg.'"
                        }
                      ],
                      "topicType": "EVENT"
                    }';

                    $query = json_decode($args, true);
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
                   // r_print($json);

                    // offer object data
                    if(!empty($FileData[9])) {
                        $OfferTitle = $FileData[9];
                        $couponCode = $FileData[10];
                        $couponurl = $FileData[11];
                        $termsConditions = $FileData[12];
                        $OfferImage = $FileData[13];

                        $OfferImg=BASE_URL.'/assets/uploads/'.session_id().'/'.$OfferImage;
                        $url1=BASE_URI.'assets/uploads/'.session_id().'/'.$OfferImage;
                        if(!file_exists($url1)){
                            $OfferImg=BASE_URL.'/assets/images/noimg.jpg';
                        }
                        $args ='{
                              "languageCode": "en-US",
                              "summary": "'.$OfferTitle.'",
                              "callToAction": {
                                  "actionType": "GET_OFFER",
                                  "url": "'.$couponurl.'"
                              },
                              "event": {
                                "title": "'.$EventName.'",
                                "schedule": {
                                  "startDate": {
                                      "year": "'.$EventStartDate[2].'",
                                      "month": "'.$EventStartDate[1].'",
                                      "day": "'.$EventStartDate[0].'"
                                  },
                                  "startTime": {
                                      "hours": "'.$EventStartTime[0].'",
                                      "minutes": "'.$EventStartTime[1].'",
                                      "seconds": "'.$EventStartTime[2].'",
                                      "nanos": "00"
                                  },
                                  "endDate": {
                                      "year": "'.$EventEndDate[2].'",
                                      "month": "'.$EventEndDate[1].'",
                                      "day": "'.$EventEndDate[0].'"
                                  },
                                  "endTime": {
                                      "hours": "'.$EventEndTime[0].'",
                                      "minutes": "'.$EventEndTime[1].'",
                                      "seconds": "'.$EventEndTime[2].'",
                                      "nanos": "00"
                                  }
                                }
                              },
                              "offer": {
                                "couponCode": "'.$couponCode.'",
                                "redeemOnlineUrl": "'.$couponurl.'",
                                "termsConditions": "'.$termsConditions.'"
                              },
                              "media": [
                                {
                                  "mediaFormat": "PHOTO",
                                  "sourceUrl":"'.$OfferImg.'"
                                }
                              ],
                              "topicType": "OFFER"
                            }';
                            $query = json_decode($args, true);
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
                    }
            }

            // post object data
            if(!empty($FileData[14])) {
                $PostTitle = $FileData[14];
                $PostUrl = $FileData[15];
                $PostImage = $FileData[16];

                $PostImg=BASE_URL.'/assets/uploads/'.session_id().'/'.$PostImage;
                $url1=BASE_URI.'assets/uploads/'.session_id().'/'.$PostImage;
                if(!file_exists($url1)){
                    $PostImg=BASE_URL.'/assets/images/noimg.jpg';
                }
                $args ='{
                      "languageCode": "en-US",
                      "summary": "'.$PostTitle.'",
                      "callToAction": {
                          "actionType": "LEARN_MORE",
                          "url": "'.$PostUrl.'"
                      },
                      "media": [
                        {
                          "mediaFormat": "PHOTO",
                          "sourceUrl":"'.$PostImg.'"
                        }
                      ],
                      "topicType": "STANDARD"
                    }';
                    $query = json_decode($args, true);
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
                   // r_print($json);
            }
        }
        $i++;
    }
    fclose($file);
    $dir = BASE_URI.'assets/uploads/'.session_id();
    deleteDir($dir);
}
