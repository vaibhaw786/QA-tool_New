<?php

session_start();
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=\"example_" . session_id() . ".csv\"");
header("Pragma: no-cache");
header("Expires: 0");
$handle = fopen('php://output', 'w');
$d = json_decode(file_get_contents('csvdata.txt'));
$i = 0;
foreach ($d as $v) {
      $data = explode(',', $v);
      if ($i != 0)
            $data[0] = base64_encode($data[0]);
      $data[1] = str_replace('&nbsp;', ' ', $data[1]);
      fputcsv($handle, $data);
      $i++;
}