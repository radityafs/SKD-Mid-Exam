<?php

require 'vendor/autoload.php';

use MiladRahimi\PhpCrypt\Symmetric;

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['algoritma']) || !isset($data['action']) || !isset($data['text'])) {
    printf(json_encode([
        'error' => 'Invalid request'
    ]));
    exit;
}

$symmetric = new Symmetric();


if (!in_array($data['algoritma'], $symmetric->supportedMethods())) {
    return printf(json_encode([
        'error' => 'Algoritma tidak didukung'
    ]));
}

$algorithm = $data['algoritma'];
$action = $data['action'];
$text = $data['text'];
$key = '1234567890123456789012';


if ($action == 'encrypt') {
    try {
        $symmetric->setKey($key);
        $symmetric->setMethod($algorithm);

        $result = $symmetric->encrypt($text);

        // convert to hex
        $result = bin2hex($result);

        // print result
        return printf(json_encode(array('result' => $result)));
    } catch (\Throwable $th) {
        return printf(json_encode(array('error' => $th->getMessage())));
    }
} else {
    try {
        $symmetric->setKey($key);
        $symmetric->setMethod($algorithm);

        // convert from hex
        $text = hex2bin($text);

        // decrypt
        $result = $symmetric->decrypt($text);

        // print result
        return printf(json_encode(array('result' => $result)));
    } catch (\Throwable $th) {
        return printf(json_encode(array('error' => $th->getMessage())));
    }
}
