<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    if(isset($_GET['id']) && isset($_SESSION['is_logged_firm_id'])){
        if($_GET['id'] == $_SESSION['is_logged_firm_id']){
            $query = $db->prepare("SELECT * FROM firma WHERE firma_id = :firma_id");
            $query->bindValue(':firma_id', $_GET['id'], PDO::PARAM_INT);
            $query->execute();
            $firm = $query->fetch();
        }
        else
            redirectToPreviousPage();
    }
    else
        redirectToPreviousPage();


    if(isset($_POST['name'])){
        $success = true;

        $address = $_POST['address'];
        $city = $_POST['city'];

        $name = $_POST['name'];
        if(mb_strlen($name) > 255){
            $success = false;
            $_SESSION['name_error'] = "Niepoprawna nazwa firmy!"; 
        }

        $nip = $_POST['nip'];
        if(!preg_match("/^[0-9]{10}$/", $nip)){
            $success = false;
            $_SESSION['nip_error'] = "Niepoprawny nip!"; 
        }

        $postal_code = $_POST['postal_code'];
        if(!preg_match('/^[0-9]{2}-?[0-9]{3}$/', $postal_code)){
            $success = false;
            $_SESSION['postal_code_error'] = "Niepoprawny kod pocztowy!";
        }

        $phone_number = $_POST['phone_number'];
        if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $phone_number) || strlen($phone_number) != 9){
            $success = false;
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
                $logo = $firm['logo'];
        }
        
        if($success){
            $query = $db->prepare("UPDATE firma SET nazwa = :nazwa, logo = :logo, nip = :nip, adres = :adres, kod_pocztowy = :kod_pocztowy, miasto = :miasto, telefon = :telefon WHERE firma_id = :firma_id");
            $query->execute(array(
                ':firma_id' => $firm['firma_id'],
                ':nazwa' => $name,
                ':logo' => $logo,
                ':nip' => $nip,
                ':adres' => $address,
                ':kod_pocztowy' => $postal_code,
                ':miasto' => $city,
                ':telefon' => $phone_number
            ));

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
    <title>Gwork | Edytuj dane firmy</title>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="rounded p-3 shadow w-50">
            <a href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/firm/firm.php?id=".$firm['firma_id']?>" id="powrot"><i class="bi bi-arrow-bar-left"></i>Powrót</a><br/>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nazwa firmy: </label>
                    <input type="text" class="form-control" id="name" name="name" value="<?=$firm['nazwa']?>">
                    <?php
                        if(isset($_SESSION['name_error'])){
                            echo '<b class="text-danger">'.$_SESSION['name_error'].'</b>'; 
                            unset($_SESSION['name_error']);
                        }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Logo firmy: </label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP: </label>
                    <input type="text" class="form-control" id="nip" name="nip" value="<?=$firm['nip']?>">
                    <?php
                        if(isset($_SESSION['nip_error'])){
                            echo '<b class="text-danger">'.$_SESSION['nip_error'].'</b>'; 
                            unset($_SESSION['nip_error']);
                        }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Adres: </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="address" placeholder="Ulica" value="<?=$firm['adres']?>">
                        <input type="text" class="form-control" name="postal_code" placeholder="Kod pocztowy" value="<?=$firm['kod_pocztowy']?>">
                        <input type="text" class="form-control" name="city" placeholder="Miasto" value="<?=$firm['miasto']?>">
                    </div>
                    <?php
                        if(isset($_SESSION['postal_code_error'])){
                            echo '<b class="text-danger">'.$_SESSION['postal_code_error'].'</b>'; 
                            unset($_SESSION['postal_code_error']);
                        }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Numer telefonu: </label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?=$firm['telefon']?>">
                    <?php
                        if(isset($_SESSION['phone_number_error'])){
                            echo '<b class="text-danger">'.$_SESSION['phone_number_error'].'</b>'; 
                            unset($_SESSION['phone_number_error']);
                        }
                    ?>
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