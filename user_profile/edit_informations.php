<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    if(isset($_GET['id']) && isset($_SESSION['is_logged_id'])){
        if($_GET['id'] == $_SESSION['is_logged_id']){
            $query = $db->prepare("SELECT * FROM uzytkownik WHERE uzytkownik_id = :uzytkownik_id");
            $query->bindValue(':uzytkownik_id', $_GET['id'], PDO::PARAM_INT);
            $query->execute();
            $account = $query->fetch();

            if($account == null)
                redirectToPreviousPage();
        }
        else
            redirectToPreviousPage();
    }
    else
        redirectToPreviousPage();

    if(isset($_POST['email'])){
        $success = true;

        $email = $_POST['email'];
        $snt_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $snt_email != $email)
        {
            $success = false;
            $_SESSION['email_error'] = "Email jest niepoprawny!";
        }
        if($email != $account['email']){
            $e_query = $db->prepare("SELECT uzytkownik_id FROM uzytkownik WHERE email = :email");
            $e_query->bindValue(':email', $email, PDO::PARAM_STR); 
            $e_query->execute();
            $e_account = $e_query->fetch();
            if($e_account)
            {
                $success = false;
                $_SESSION['email_error'] = "Istnieje już konto z tym adresem email!";
            }
        }
        
        $new_pass1 = $_POST['new_password1'];
        $new_pass2 = $_POST['new_password2'];
        $pass = $_POST['password'];

        if($new_pass1 != null){
            if(strlen($new_pass1) < 8 || strlen($new_pass1) > 30){
                $success = false;
                $_SESSION['new_password1_error'] = "Hasło musi mieć długość od 8 do 30 znaków!";
            }

            if($new_pass2  != $new_pass1){
                $success = false;
                $_SESSION['new_password2_error'] = "Hasła nie są identyczne!";
            }

            if(!password_verify($pass, $account['haslo'])){
                $success = false;
                $_SESSION['password_error'] = "Niepoprawne hasło!";
            }
        }

        if($success){
            if($new_pass1 != null){
                $new_pass_hash = password_hash($new_pass1, PASSWORD_DEFAULT);
                $query = $db->prepare("UPDATE uzytkownik SET haslo = :haslo, email = :email WHERE uzytkownik_id = :uzytkownik_id");
                $query->bindValue(':haslo', $new_pass_hash, PDO::PARAM_STR);
            }
            else
                $query = $db->prepare("UPDATE uzytkownik SET email = :email WHERE uzytkownik_id = :uzytkownik_id");

            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':uzytkownik_id', $_SESSION['is_logged_id'], PDO::PARAM_INT);
            $query->execute();

            unset($_SESSION['is_logged_login']);
            unset($_SESSION['is_logged_id']);
            unset($_SESSION['is_logged_firm_id']);
            unset($_SESSION['is_logged_info_id']);

            header('Location: '.$protocol.$_SERVER['HTTP_HOST'].'/gwork/index.php'); 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/style.css"?>">
    <title>Gwork | Edytuj dane</title>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="rounded p-3 shadow w-50">
            <a href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/user_profile/user_profile.php?id=".$account['uzytkownik_id']?>" id="powrot"><i class="bi bi-arrow-bar-left"></i>Powrót</a><br/>
            <form method="POST">
                <div class="my-3">
                    <label for="email" class="form-label">Nowy Email: </label>
                    <input type="text" class="form-control" id="email" name="email" value="<?=$account['email']?>">
                    <?php if(isset($_SESSION['email_error'])){
                        echo '<b class="text-danger">'.$_SESSION['email_error'].'</b>'; 
                        unset($_SESSION['email_error']);
                    } ?>
                </div>
                <div class="my-3">
                    <label for="new_password1" class="form-label">Nowe Hasło: </label>
                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                    <?php if(isset($_SESSION['new_password1_error'])){
                        echo '<b class="text-danger">'.$_SESSION['new_password1_error'].'</b>'; 
                        unset($_SESSION['new_password1_error']);
                    } ?>
                </div>

                <div class="my-3">
                    <label for="new_password2" class="form-label">Powtórz nowe hasło: </label>
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                    <?php if(isset($_SESSION['new_password2_error'])){
                        echo '<b class="text-danger">'.$_SESSION['new_password2_error'].'</b>'; 
                        unset($_SESSION['new_password2_error']);
                    } ?>
                </div>

                <div class="my-3">
                    <label for="new_password2" class="form-label">Aktualne Hasło: </label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php if(isset($_SESSION['password_error'])){
                        echo '<b class="text-danger">'.$_SESSION['password_error'].'</b>'; 
                        unset($_SESSION['password_error']);
                    } ?>
                </div>
                
                <button type="submit" class="btn btn-primary px-3 mx-auto d-block">Edytuj</button>
            </form>              
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>