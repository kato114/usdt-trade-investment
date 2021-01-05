<?php

function build_table($array){
    // start table
    $html = '<table border="1" width="600" style="border-collapse:collapse;">';
    // header row
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
        $html .= '<th align="left">' . htmlspecialchars($key) . '</th>';
    }
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}

function title($str){
    return ucwords( implode(" ", explode("_",$str)));
}

$input = array_merge($_GET, $_POST);

if(isset($input['g-recaptcha-response'])) {
    unset($input['g-recaptcha-response']);
}

$body ="Contact us : From The Website,<br><br>";
$data  = [];
foreach ($input as $key => $value){
    $data[] =['Field' => title($key), 'Value' => $value];
}

$body.= build_table($data);

$to = "jackryland@hotmail.com";
$subject = "Contact us from website " . @$input['first_name'];

$request = http_build_query(compact('to','subject','body'));
echo file_get_contents("https://accounts.arbitrage-trading.net/api/mail?$request");
header("content-type: application/json");
$response =['isOk' => true,'message' => "Your request has been received and we will be in touch with you soon."];
echo( json_encode($response));
?>