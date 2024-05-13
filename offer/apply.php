<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    if(!isset($_GET['id']) || !isset($_SESSION['is_logged_id']) || isset($_SESSION['is_logged_firm_id'])){
        redirectToPreviousPage();
    }
    else{
        $query = $db->prepare("SELECT * FROM ogloszenie WHERE ogloszenie_id = :ogloszenie_id");
        $query->bindValue(':ogloszenie_id', $_GET['id'], PDO::PARAM_INT);
        $query->execute();

        if($query->rowCount() == 0)
            redirectToPreviousPage();
        else{
            $query = $db->prepare("SELECT * FROM aplikacja WHERE ogloszenie_id = :ogloszenie_id AND uzytkownik_id = :uzytkownik_id");
            $query->bindValue(':ogloszenie_id', $_GET['id'], PDO::PARAM_INT);
            $query->bindValue(':uzytkownik_id', $_SESSION['is_logged_id'], PDO::PARAM_INT);
            $query->execute();
    
            if($query->rowCount() > 0)
                redirectToPreviousPage();
            else{
                $query = $db->prepare("INSERT INTO aplikacja (uzytkownik_id, ogloszenie_id, status_aplikacji_id) VALUES ( :uzytkownik_id, :ogloszenie_id, 1)");
                $query->bindValue(':uzytkownik_id', $_SESSION['is_logged_id'], PDO::PARAM_INT);
                $query->bindValue(':ogloszenie_id', $_GET['id'], PDO::PARAM_INT);
                $query->execute();
    
                redirectToPreviousPage();
            }
        }
    }