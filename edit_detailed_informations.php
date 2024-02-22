<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    session_start();

    if(!isset($_SESSION['is_logged_login'])){
        if(isset($_SERVER["HTTP_REFERER"])) 
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        else
            header('Location: '.$protocol.$_SERVER['HTTP_HOST'].'/gwork/index.php');
    }

    $query = $db->prepare("SELECT * FROM uzytkownik_informacje WHERE uzytkownik_id = :uzytkownik_id");
    $query->bindValue(':uzytkownik_id', $_SESSION['is_logged_id'], PDO::PARAM_INT);
    $query->execute();
    $informations = $query->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwork | Twój profil</title>
    <link rel="stylesheet" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/style.css"?>">
</head>
<body class="bg-light">

</body>
</html>