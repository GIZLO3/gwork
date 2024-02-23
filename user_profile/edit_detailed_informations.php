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

    if(isset($_POST['phone_number']))
    {
        $succes = true;

        $phone_number = $_POST['phone_number'];
        if(!empty($_POST['numer_telefonu']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $phone_number) || strlen($phone_number) != 9){
                $succes = false;
                $_SESSION['phone_number_error'] = "Niepoprawny numer telefonu!";
            }
        }
        else
            $phone_number = null;

        $birth_date = $_POST['birth_date'];
        if(empty($_POST['birth_date']))
            $birth_date = null;

        $address = $_POST['address'];
        if(!empty($_POST['address']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $address)){
                $succes = false;
                $_SESSION['address_error'] = "Adres posiada niedozwolone znaki specjane!"; 
            }
        }
        else
            $address = null;


        $postal_code = $_POST['postal_code'];
        if(!empty($_POST['address']))
        {
            if(!preg_match('/^[0-9]{2}-?[0-9]{3}$/', $postal_code)){
                $succes = false;
                $_SESSION['postal_code_error'] = "Niepoprawny kod pocztowy!";
            }
        }
        else
            $postal_code = null;

        $city = $_POST['city'];
        if(!empty($_POST['city']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $city)){
                $succes = false;
                $_SESSION['address_error'] = "Miasto posiada niedozwolone znaki specjane!"; 
            }
        }
        else
            $city = null;

        $ocupation = $_POST['ocupation'];
        if(!empty($_POST['ocupation']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $ocupation)){
                $succes = false;
                $_SESSION['address_error'] = "Niedozwolone znaki specjane!"; 
            }
        }
        else
            $ocupation = null;

        $ocupation_summary = array();
        $i = 1;
        while(1){
            if(isset($_POST['ocupation_summary'.$i])){
                if(!empty($_POST['ocupation_summary'.$i]))
                    array_push($ocupation_summary, $_POST['ocupation_summary'.$i]);
                $i++;
            }   
            else
                break;
        }

        if($succes)
        {
            $query = $db->prepare("UPDATE uzytkownik_informacje SET numer_telefonu = :numer_telefonu, data_urodzenia = :data_urodzenia, adres = :adres, kod_pocztowy = :kod_pocztowy, miasto = :miasto, 
                stanowisko_pracy = :stanowisko_pracy, 
                podsumowanie_zawodowe= :podsumowanie_zawodowe
                WHERE uzytkownik_id = :uzytkownik_id");
            $query->execute(array(
                ':numer_telefonu' => $phone_number,
                ':data_urodzenia' => $birth_date,
                ':adres' => $address,
                ':kod_pocztowy' => $postal_code,
                ':miasto' => $city,
                ':stanowisko_pracy' => $ocupation,
                ':podsumowanie_zawodowe' => json_encode($ocupation_summary),
                ':uzytkownik_id' => $_SESSION['is_logged_id']
            ));

            header('Location: '.$protocol.$_SERVER['HTTP_HOST'].'/gwork/index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwork | Edytuj profil</title>
    <link rel="stylesheet" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/style.css"?>">
</head>
<body class="bg-light">
    <form action="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/user_profile/edit_detailed_informations.php"?>" method="post">
        tel
        <input type="tel" name="phone_number" id="">
        data
        <input type="date" name="birth_date" id="">
        ulica
        <input type="text" name="address" id="">
        kod-pocztowy
        <input type="text" name="postal_code" id="">
        miejscowosc
        <input type="text" name="city" id="">
        stanowisko pracy
        <input type="text" name="ocupation" id="">
        inforacja 1
        <input type="text" name="ocupation_summary1" id="">
        inforacja 2
        <input type="text" name="ocupation_summary2" id="">
        <button type="submit">Wyślij</button>
    </form>
</body>
</html>