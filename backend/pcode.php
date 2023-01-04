<?php

$pincode = $_POST['pincode'];
$data = file_get_contents('https://api.postalpincode.in/pincode/' . $pincode);
$data = json_decode($data, true);
// echo '<pre>';
// print_r($data);
if (isset($data[0]["PostOffice"][0])) {
    $arr['city'] = $data[0]["PostOffice"][0]["District"];
    $arr['state'] = $data[0]["PostOffice"][0]["State"];
    echo json_encode($arr);
} else {
    echo "no";
}



?>