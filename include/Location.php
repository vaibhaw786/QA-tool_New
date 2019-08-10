<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// r_print($_POST);
#header("Content-type: application/csv");
#header("Content-Disposition: attachment; filename=\"example".".csv\"");
#header("Pragma: no-cache");
#header("Expires: 0");
#$handle = fopen('php://output', 'w');
//r_print($_SERVER);

    $data = array();
    $data[] = "BusinessID,BusinessName,EventName,EventStartDate,EventEndDate,EventStartTime,EventEndTime,EventUrl,EventImage,OfferTitle,couponCode,couponurl,termsConditions,OfferImage,PostTitle,PostUrl,PostImage";
    foreach ($_POST['accounts'] as $account) {
        $BUSINESSID = explode('/', json_decode(base64_decode($account))->name);
        $BUSINESSID = $BUSINESSID[count($BUSINESSID) - 1];
        $BUSINESSName = str_replace(',', '&nbsp;', json_decode(base64_decode($account))->locationName);
        $data[] = $BUSINESSID . ',' . $BUSINESSName.',,,,,,,,,,,,,,,';
    }
file_put_contents('csvdata.txt', json_encode($data));

echo '<center><a class="btn btn-primary" href="downloadcsv.php">Download CSV <i class="fa fa-cloud-download"></i></a></center>';
$data = json_decode(file_get_contents('csvdata.txt'));
#r_print($data);
echo '<br><br><div class="overflow"><table class="table table-stripe">';
$i = 0;
foreach ($data as $v1) {
    echo '<tr>';
    $col = 'td';
    if ($i == 0) {
        $col = 'th';
    }
    $FileData = (explode(',', $v1));

    foreach ($FileData as $v) {

        echo '<' . $col . '>' . $v . '</' . $col . '>';
    }
    echo '</tr>';

    $i++;
}
echo '</table></div>';
?>

