<?php

require 'vendor/autoload.php';
use PhpAes\Aes;

$data = json_decode(file_get_contents('php://input'), true);

if(!isset($data['algoritma']) || !isset($data['action']) || !isset($data['text'])) {
    echo "Data tidak lengkap";
    exit;
}

$algorithm = $data['algoritma'];
$action = $data['action'];
$text = $data['text'];

// first vector
$iv = "1234567890123456";

$key = "";
switch ($algorithm) {
    case 'AES128':
        $key = "1234567890123456";
        break;
    case 'AES192':
        $key = "123456789012345678901234";
        break;
    case 'AES256':
        $key = "12345678901234567890123456789012";
        break;
    default:
        $key = "1234567890123456";
        break;
    break;
}


// AES CBC
$aes = new Aes($key, 'CBC', $iv);

if($action == 'encrypt') {

    // encrypt
    $result = $aes->encrypt($text);

    // convert to hex
    $result = bin2hex($result);
    
    // print result
    return printf(json_encode(array('result' => $result)));
} else {
    // convert to binary
    $text = hex2bin($text);

    // decrypt
    $result = $aes->decrypt($text);

    // print result
    return printf(json_encode(array('result' => $result)));
}
