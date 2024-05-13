<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    unset($_SESSION['is_logged_login']);
    unset($_SESSION['is_logged_id']);
    unset($_SESSION['is_logged_firm_id']);
    unset($_SESSION['is_logged_info_id']);
    
    redirectToPreviousPage();