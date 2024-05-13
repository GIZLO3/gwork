<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    if(isset($_POST['login']))
    {
        $success = true;

        //SPRAWDZANIE LOGINU
        $login = $_POST['login'];
        if(strlen($login) < 4 || strlen($login) > 25){
            $success = false;
            $_SESSION['login_error'] = "Login musi mieć długość od 4 do 25 znaków!";
        }
        if(!ctype_alnum($login))
        {
            $success = false;
            $_SESSION['login_error'] = "Login może składać się tylko z liter i cyfr!";
        }
        $l_query = $db->prepare("SELECT uzytkownik_id FROM uzytkownik WHERE login = :login");
        $l_query->bindValue(':login', $login, PDO::PARAM_STR); $l_query->execute();
        $account = $l_query->fetch();
        if($account)
        {
            $success = false;
            $_SESSION['login_error'] = "Podany login już istnieje!";
        }

        //SPRAWDZANIE EMAILA
        $email = $_POST['email'];
        $snt_email = filter_var($email, FILTER_SANITIZE_EMAIL); //usuwanie polskich znaków itp
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $snt_email != $email)
        {
            $success = false;
            $_SESSION['email_error'] = "Email jest niepoprawny!";
        }
        $e_query = $db->prepare("SELECT uzytkownik_id FROM uzytkownik WHERE email = :email");
        $e_query->bindValue(':email', $email, PDO::PARAM_STR); $e_query->execute();
        $account = $e_query->fetch();
        if($account)
        {
            $success = false;
            $_SESSION['email_error'] = "Istnieje już konto z tym adresem email!";
        }

        //SPRAWDZANIE HASŁA
        $pass1 = $_POST['password1'];
        $pass2 = $_POST['password2'];

        if(strlen($pass1) < 8 || strlen($pass1) > 30){
            $success = false;
            $_SESSION['pass_error'] = "Hasło musi mieć długość od 8 do 30 znaków!";
        }

        if($pass2 != $pass1){
            $success = false;
            $_SESSION['pass2_error'] = "Hasła nie są identyczne!";
        }

        if(isset($_GET['registerFirm'])){  
            $address = $_POST['address'];
            $city = $_POST['city'];

            $name = $_POST['name'];
            if(mb_strlen($name) > 255){
                $succes = false;
                $_SESSION['name_error'] = "Niepoprawna nazwa firmy!"; 
            }

            $nip = $_POST['nip'];
            if(!preg_match("/^[0-9]{10}$/", $nip)){
                $succes = false;
                $_SESSION['nip_error'] = "Niepoprawny nip!"; 
            }

            $postal_code = $_POST['postal_code'];
            if(!preg_match('/^[0-9]{2}-?[0-9]{3}$/', $postal_code)){
                $succes = false;
                $_SESSION['postal_code_error'] = "Niepoprawny kod pocztowy!";
            }

            $phone_number = $_POST['phone_number'];
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $phone_number) || strlen($phone_number) != 9){
                $succes = false;
                $_SESSION['phone_number_error'] = "Niepoprawny numer telefonu!";
            }
            
            $dir = $_SERVER['DOCUMENT_ROOT'].'/gwork/img/';
            if(isset($_FILES['file']))
            {
                $info = explode('.', strtolower( $_FILES['file']['name'])); 

                if (in_array( end($info), array("jpg", "jpeg", "png", "webp")))
                {
                    if (move_uploaded_file( $_FILES['file']['tmp_name'], $dir . basename($_FILES['file']['name'])))
                    {
                        $logo = "/img/".$_FILES['file']['name'];
                    }
                }
                else
                    $success = false;
            }
        }

        if($success){
            if(isset($_GET['registerFirm'])){   
                $query = $db->prepare("INSERT INTO firma (nazwa, logo, nip, adres, kod_pocztowy, miasto, telefon) VALUES(:nazwa, :logo, :nip, :adres, :kod_pocztowy, :miasto, :telefon)");
                $query->execute(array(
                    ':nazwa' => $name,
                    ':logo' => $logo,
                    ':nip' => $nip,
                    ':adres' => $address,
                    ':kod_pocztowy' => $postal_code,
                    ':miasto' => $city,
                    ':telefon' => $phone_number
                ));
                $company_id  = $db->lastInsertId();
                $info_id = null;
            }
            else{
                $query = $db->prepare("INSERT INTO uzytkownik_informacje (informacje_id) VALUES(NULL)");
                $query->execute();
                $info_id = $db->lastInsertId();
                $company_id = null;
            }

            $query = $db->prepare("INSERT INTO uzytkownik (login, email, haslo, informacje_id, firma_id) VALUES (:login, :email, :haslo, :informacje_id, :firma_id)");
            $query->bindValue(':login', $login, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
            $query->bindValue(':haslo', $pass_hash, PDO::PARAM_STR);
            $query->bindValue(':informacje_id', $info_id, PDO::PARAM_INT);
            $query->bindValue(':firma_id', $company_id, PDO::PARAM_INT);
            $query->execute();

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
    <title>Gwork | Zarejestruj się</title>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="rounded p-3 shadow w-50" id="register">
            <a href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/index.php"?>" id="powrot"><i class="bi bi-arrow-bar-left"></i>Powrót</a><br/>
            <?php
                if(isset($_GET['registerFirm'])){
                    echo '<form method="POST" enctype="multipart/form-data" action="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/register.php?registerFirm">';
                }
                else{
                    echo '<form method="POST" action="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/register.php">';
                }
            ?>
            
                <div class="mb-3">
                    <label for="login" class="form-label">Login: </label>
                    <input type="text" class="form-control" id="login" name="login">
                    <?php if(isset($_SESSION['login_error'])){
                        echo '<b class="text-danger">'.$_SESSION['login_error'].'</b>'; 
                        unset($_SESSION['login_error']);
                    } ?>
                </div>

                <div class="my-3">
                    <label for="email" class="form-label">Email: </label>
                    <input type="text" class="form-control" id="email" name="email">
                    <?php if(isset($_SESSION['email_error'])){
                        echo '<b class="text-danger">'.$_SESSION['email_error'].'</b>'; 
                        unset($_SESSION['email_error']);
                    } ?>
                </div>
                <div class="my-3">
                    <label for="password1" class="form-label">Hasło: </label>
                    <input type="password" class="form-control" id="password1" name="password1">
                    <?php if(isset($_SESSION['pass_error'])){
                        echo '<b class="text-danger">'.$_SESSION['pass_error'].'</b>'; 
                        unset($_SESSION['pass_error']);
                    } ?>
                </div>

                <div class="my-3">
                    <label for="password2" class="form-label">Powtórz hasło: </label>
                    <input type="password" class="form-control" id="password2" name="password2">
                    <?php if(isset($_SESSION['pass2_error'])){
                        echo '<b class="text-danger">'.$_SESSION['pass2_error'].'</b>'; 
                        unset($_SESSION['pass2_error']);
                    } ?>
                </div>

                <?php
                    if(isset($_GET['registerFirm'])){
                        echo '
                        <div class="mb-3">
                            <label for="name" class="form-label">Nazwa firmy: </label>
                            <input type="text" class="form-control" id="name" name="name">';
                            if(isset($_SESSION['name_error'])){
                                echo '<b class="text-danger">'.$_SESSION['name_error'].'</b>'; 
                                unset($_SESSION['name_error']);
                            }
                        echo '</div>';

                        echo '
                        <div class="mb-3">
                            <label for="file" class="form-label">Logo firmy: </label>
                            <input type="file" class="form-control" id="file" name="file">';
                        echo '</div>';

                        echo '
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP: </label>
                            <input type="text" class="form-control" id="nip" name="nip">';
                            if(isset($_SESSION['nip_error'])){
                                echo '<b class="text-danger">'.$_SESSION['nip_error'].'</b>'; 
                                unset($_SESSION['nip_error']);
                            }
                        echo '</div>';

                        echo '
                        <div class="mb-3">
                            <label for="address" class="form-label">Adres: </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="address" placeholder="Ulica">
                                <input type="text" class="form-control" name="postal_code" placeholder="Kod pocztowy">
                                <input type="text" class="form-control" name="city" placeholder="Miasto">
                            </div>';
                            if(isset($_SESSION['postal_code_error'])){
                                echo '<b class="text-danger">'.$_SESSION['postal_code_error'].'</b>'; 
                                unset($_SESSION['postal_code_error']);
                            }
                        echo '</div>';

                        echo '
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Numer telefonu: </label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number">';
                            if(isset($_SESSION['phone_number_error'])){
                                echo '<b class="text-danger">'.$_SESSION['phone_number_error'].'</b>'; 
                                unset($_SESSION['phone_number_error']);
                            }
                        echo '</div>';
                    }
                ?>


                <div class="d-flex align-items-end">
                    <?php
                        if(isset($_GET['registerFirm'])){
                            echo '<button type="submit" class="btn btn-primary me-2">Zarejestruj firmę</button>';
                        }
                        else{
                            echo '<button type="submit" class="btn btn-primary me-2">Zarejestruj się</button>';
                            echo '<span>Posiadasz firmę? <a href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/register.php?registerFirm" class="">Zarejestruj firmę</a></span>';
                        }
                    ?>
                </div>         
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>