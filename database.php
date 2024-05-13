<?php
    $config = array('host' => 'localhost', 'user' => 'root', 'password' => '', 'database' => 'gwork');

    try
    {
        $db = new PDO("mysql:host={$config['host']}; dbname={$config['database']}; charset=utf8", $config['user'], $config['password']);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Błąd bazy danych: ".$e->getMessage();
    }

    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';

    function redirectToPreviousPage() {
        if(isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
            header('Location: '.$protocol.$_SERVER['HTTP_HOST'].'/gwork/index.php');
        }
    }
?>