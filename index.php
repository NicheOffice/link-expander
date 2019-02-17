<?php
require(__DIR__ . '/system/config.php');
require(__DIR__ . '/system/functions.php');
require(__DIR__ . '/language/' . $config['language'] . '.php');
session_start();
$_SESSION['token'] = csrfToken();
include(__DIR__ . '/template/' . $config['template'] . '/header.php');
include(__DIR__ . '/template/' . $config['template'] . '/main.php');
include(__DIR__ . '/template/' . $config['template'] . '/footer.php');