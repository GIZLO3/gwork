<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    if(!isset($_SESSION['is_logged_login']))
    {
        if(isset($_POST['login']))
        {
            $login = filter_input(INPUT_POST, 'login');
            $pass =  filter_input(INPUT_POST, 'password');

            $query = $db->prepare("SELECT * FROM uzytkownik WHERE login = :login");
            $query->bindValue(':login', $login, PDO::PARAM_STR);
            $query->execute();

            $account = $query->fetch();

            if($account && password_verify($pass, $account['haslo'])){
                $_SESSION['is_logged_login'] = $account['login'];
                $_SESSION['is_logged_id'] = $account['uzytkownik_id'];
                $_SESSION['is_logged_email'] = $account['email'];
                //$_SESSION['is_admin'] = $account['admin'];
                unset($_SESSION['login_error']);
            }
            else{
                $_SESSION['login_error'] = "Login lub hasło jest niepoprawne!";
            }   
        }
    }

    if(isset($_SERVER["HTTP_REFERER"])) 
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    else
        header('Location: '.$protocol.$_SERVER['HTTP_HOST'].'/gwork/index.php');
   
    exit();