<?php
    session_start();
    unset($_SESSION['is_logged_login']);
    unset($_SESSION['is_logged_id']);
    unset($_SESSION['is_logged_name']);

    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
    if (isset($_SERVER["HTTP_REFERER"])) 
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    else
        header("Location: {$protocol}{$_SERVER['HTTP_HOST']}/gwork/index.php");