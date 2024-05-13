<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    if(!isset($_SESSION['is_logged_firm_id'])){
        redirectToPreviousPage();
    }

    if(isset($_POST['position'])){
        $success = true;

        $position = $_POST['position'];

        $address = $_POST['address'];
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];
        if(!preg_match('/^[0-9]{2}-?[0-9]{3}$/', $postal_code)){
            $success = false;
            $_SESSION['postal_code_error'] = "Niepoprawny kod pocztowy!";
        }

        $lowest_salary = $_POST['lowest_salary'];
        $highest_salary = $_POST['highest_salary'];

        $expire_date = $_POST['expire_date'];
        $category = $_POST['category'];
        $concract_type = $_POST['concract_type'];
        $job_level = $_POST['job_level'];
        $working_time = $_POST['working_time'];
        $work_mode = $_POST['work_mode'];

        
        $duties = array();
        $i = 0;
        while(isset($_POST['duties'.$i])){
            if(!empty($_POST['duties'.$i]))
                array_push($duties, $_POST['duties'.$i]);
            $i++;
        }

        $requirements = array();
        $i = 0;
        while(isset($_POST['requirements'.$i])){
            if(!empty($_POST['requirements'.$i]))
                array_push($requirements, $_POST['requirements'.$i]);
            $i++;
        }
     
        if($success && isset($_SESSION['is_logged_firm_id'])){
            $query = $db->prepare("INSERT INTO  ogloszenie (firma_id, stanowisko, waznosc, ogloszenie_adres, ogloszenie_kod_pocztowy, ogloszenie_miasto, wynagrodzenie_od, wynagrodzenie_do, kategoria_id, rodzaj_umowy_id, poziom_stanowiska_id, wymiar_pracy_id, tryb_pracy_id, obowiazki, wymagania) 
                VALUES (:firma_id, :stanowisko, :waznosc, :ogloszenie_adres, :ogloszenie_kod_pocztowy, :ogloszenie_miasto, 
                :wynagrodzenie_od, :wynagrodzenie_do, 
                :kategoria_id, :rodzaj_umowy_id, :poziom_stanowiska_id, :wymiar_pracy_id, :tryb_pracy_id, 
                :obowiazki, :wymagania)");
            $query->execute(array(
                ':firma_id' => $_SESSION['is_logged_firm_id'],
                ':stanowisko' => $position,
                ':waznosc' => $expire_date,
                ':ogloszenie_adres' => $address,
                ':ogloszenie_kod_pocztowy' => $postal_code,
                ':ogloszenie_miasto' => $city,
                ':wynagrodzenie_od' => $lowest_salary,
                ':wynagrodzenie_do' => $highest_salary,
                ':kategoria_id' => $category,
                ':rodzaj_umowy_id' => $concract_type,
                ':poziom_stanowiska_id' => $job_level,
                ':wymiar_pracy_id' => $working_time,
                ':tryb_pracy_id' => $work_mode,
                ':obowiazki' => json_encode($duties),
                ':wymagania' => json_encode($requirements)
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
    <title>Gwork | Dodaj ogłoszenie</title>
</head>
<body class="bg-light">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/create_navbar.php');?>

    <div class="container mt-5">
        <form method="post">
            <div class="row g-2">
                <div class="col-md-12 col-lg-6">
                    <div class="bg-white rounded shadow-sm p-3">
                        <span class="fw-bold fs-4">Dodaj Ogłoszenie o Pracę</span>

                        <div class="form-floating mt-2">
                            <input type="text" class="form-control" id="position" placeholder="Stanowisko" name="position">
                            <label for="position">Stanowisko</label>
                        </div>

                        <div class="input-group mt-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Adres">
                                <label for="address">Adres</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Kod pocztowy">
                                <label for="postal_code">Kod pocztowy</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="miasto" name="city" placeholder="Miasto">
                                <label for="city">Miasto</label>
                            </div>
                        </div>
                        <?php
                            if(isset($_SESSION['postal_code_error'])){
                                echo '<b class="text-danger">'.$_SESSION['postal_code_error'].'</b>'; 
                                unset($_SESSION['postal_code_error']);
                            }
                        ?>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6">
                    <div class="bg-white rounded shadow-sm p-3">
                        <span class="fw-semibold fs-4">Płaca Brutto i Ważność</span>

                        <div class="input-group mt-2">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="lowest_salary" name="lowest_salary" placeholder="Minimalna" step="0.01">
                                <label for="lowest_salary">Minimalna</label>
                            </div>
                            <span class="input-group-text">zł</span>
                            <div class="form-floating">
                                <input type="number" class="form-control" id="highest_salary" name="highest_salary" placeholder="Maksymalna" step="0.01">
                                <label for="highest_salary">Maksymalna</label>
                            </div>
                            <span class="input-group-text">zł</span>
                        </div>

                        <div class="form-floating mt-2">
                            <input type="date" class="form-control" id="expire_date" name="expire_date" placeholder="Ważność ogłoszenia">
                            <label for="expire_date">Ważność ogłoszenia</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6"> 
                    <div class="bg-white rounded shadow-sm p-3">
                        <div class="row g-2">
                            <div class="col-12">
                                <select class="form-select h-100 py-3" name="category">
                                    <option selected>Katergoria</option>
                                    <?php
                                        $query = $db->prepare("SELECT * FROM kategoria");
                                        $query->execute();
                                        
                                        while($options = $query->fetch()){
                                            echo '<option value="'.$options['kategoria_id'].'">'.$options['kategoria'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="form-select" name="concract_type">
                                    <option selescted>Rodzaj umowy</option>
                                    <?php
                                        $query = $db->prepare("SELECT * FROM rodzaj_umowy");
                                        $query->execute();
                                        
                                        while($options = $query->fetch()){
                                            echo '<option value="'.$options['rodzaj_umowy_id'].'">'.$options['rodzaj_umowy'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="form-select" name="job_level">
                                    <option selected>Poziom stanowiska</option>
                                    <?php
                                        $query = $db->prepare("SELECT * FROM poziom_stanowiska");
                                        $query->execute();
                                        
                                        while($options = $query->fetch()){
                                            echo '<option value="'.$options['poziom_stanowiska_id'].'">'.$options['poziom_stanowiska'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="form-select" name="working_time">
                                    <option selected>Wymiar pracy</option>
                                    <?php
                                        $query = $db->prepare("SELECT * FROM wymiar_pracy");
                                        $query->execute();
                                        
                                        while($options = $query->fetch()){
                                            echo '<option value="'.$options['wymiar_pracy_id'].'">'.$options['wymiar_pracy'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="form-select" name="work_mode">
                                    <option selected>Tryb pracy</option>
                                    <?php
                                        $query = $db->prepare("SELECT * FROM tryb_pracy");
                                        $query->execute();
                                        
                                        while($options = $query->fetch()){
                                            echo '<option value="'.$options['tryb_pracy_id'].'">'.$options['tryb_pracy'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <hr class="mb-3">

                        <span class="fw-semibold fs-4">Wymagania</span>
                        <ul class="list-group list-group-flush" id="requirements">
                        </ul>
                        <button type="button" class="btn btn-primary d-block ms-auto me-3" onclick="addTextarea('requirements')"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6">
                    <div class="bg-white rounded shadow-sm p-3">
                        <span class="fw-semibold fs-4">Obowiązki</span>
                        <ul class="list-group list-group-flush" id="duties">
                        </ul>
                        <button type="button" class="btn btn-primary d-block ms-auto me-3" onclick="addTextarea('duties')"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary mx-auto d-block px-4 py-3">Dodaj ogłoszenie</button>
                </div>
            </div>     
        </form>
    </div>

    <script src="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/js/add_offer.js"?>"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</body>
</html>