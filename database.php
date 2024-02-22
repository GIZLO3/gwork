<?php
    $config = array('host' => 'localhost', 'user' => 'root', 'password' => '', 'database' => 'gwork');

    try
    {
        $db = new PDO("mysql:host={$config['host']}; dbname={$config['database']}; charset=utf8", $config['user'], $config['password']);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //zabezpieczenie przed SQL injection
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Błąd bazy danych: ".$e->getMessage();
    }

    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
?>