<?php
include(__DIR__ . '/config.php');
include(__DIR__ . '/functions.php');
session_start();
if (!empty($_POST['url']) && hash_equals($_SESSION['token'], $_POST['token'])) {
    $data = getData($_POST['url'], $config['apiKey']);
    header('Content-Type: application/json');
    echo json_encode($data);
    die();
}else{
    die('error');
}