<?php
require_once '../functions.php';

if (isset($_POST["action"]) && $_POST["action"] == 'upload') {
    $target_dir = BASE_URI."assets/uploads/" . session_id() . '/';
    $target_file = $target_dir . (session_id() . '.csv');
    $file = fopen($target_file, "r");
    $i=0;
    $res = array();
    while (!feof($file)) {
        $FileData=(fgetcsv($file));
        if($i) {
            $accountid = $_SESSION['accountid'];
            $BusinessID = $FileData[0];
            $BusinessID = base64_decode($BusinessID);
            $x = $accountid.'/locations/'.$BusinessID.'/questions';
            $userinfo = $_SESSION['userinfo'];
            $userinfo = json_decode($userinfo);
            $access_token = $userinfo->access_token;
            $request_uri = "https://mybusiness.googleapis.com/v4/$x/?access_token=" . $access_token;
            // question answer object data
            if(!empty($FileData[2])) {
                $Question = $FileData[2];
                $Answer = $FileData[3];
                $args ='{
                      "text": "'.$Question.'"
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
                   // r_print($json);
                    $phpObj = json_decode($json, true);
                    $res[] = array($Question, $phpObj);
                    $QuestionID = $phpObj['name'];
                    if(!empty($Answer)) {
                      $x = $QuestionID.'/answers:upsert';
                      $request_uri = "https://mybusiness.googleapis.com/v4/$x/?access_token=" . $access_token;
                      $args ='{
                        "answer": {
                          "text": "'.$Answer.'"
                        }
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
                    }

            }
        }
        $i++;
    }
    echo json_encode($res);
    fclose($file);
    $dir = BASE_URI.'assets/uploads/'.session_id();
    deleteDir($dir);
}
