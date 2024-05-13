<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwork | Oferty pracy</title>
    <link rel="stylesheet" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/style.css"?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body class="bg-light">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/create_navbar.php');?>

    <div class="container">
        <div class="p-3 mt-2">
            <form>
                <div class="row gx-1 gy-2">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="keyword" placeholder="Słowo kluczowe" name="keyword">
                            <label for="keyword">Słowo kluczowe</label>
                        </div> 
                    </div>
                    <div class="col-12 col-md-2 col-lg-4">
                        <select class="form-select h-100" id="category">
                            <option value="0" selected>-Katergoria-</option>
                            <?php
                                $query = $db->prepare("SELECT * FROM kategoria");
                                $query->execute();
                                
                                while($options = $query->fetch()){
                                    echo '<option value="'.$options['kategoria_id'].'">'.$options['kategoria'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="input-group">
                            <div class="form-floating w-75">
                                <input type="text" class="form-control" id="location" placeholder="Lokalizacja">
                                <label for="location">Lokalizacja</label>
                            </div>
                            <select class="form-select w-25" id="location_raduis">
                                <option value="0" selected>+0 km</option>
                                <option value="10">+10 km</option>
                                <option value="20">+20 km</option>
                                <option value="30">+30 km</option>
                                <option value="50">+50 km</option>
                            </select>
                        </div>                
                    </div> 
                    <div class="col-12 col-md-3">
                        <select class="form-select" id="job_level">
                            <option value="0" selected>-Poziom stanowiska-</option>
                            <?php
                                $query = $db->prepare("SELECT * FROM poziom_stanowiska");
                                $query->execute();
                                
                                while($options = $query->fetch()){
                                    echo '<option value="'.$options['poziom_stanowiska_id'].'">'.$options['poziom_stanowiska'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <select class="form-select" id="concract_type">
                            <option value="0" selected>-Rodzaj umowy-</option>
                            <?php
                                $query = $db->prepare("SELECT * FROM rodzaj_umowy");
                                $query->execute();
                                
                                while($options = $query->fetch()){
                                    echo '<option value="'.$options['rodzaj_umowy_id'].'">'.$options['rodzaj_umowy'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <select class="form-select" id="working_time">
                            <option value="0" selected>-Wymiar pracy-</option>
                            <?php
                                $query = $db->prepare("SELECT * FROM wymiar_pracy");
                                $query->execute();
                                
                                while($options = $query->fetch()){
                                    echo '<option value="'.$options['wymiar_pracy_id'].'">'.$options['wymiar_pracy'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <select class="form-select" id="work_mode">
                            <option value="0" selected>-Tryb pracy-</option>
                            <?php
                                $query = $db->prepare("SELECT * FROM tryb_pracy");
                                $query->execute();
                                
                                while($options = $query->fetch()){
                                    echo '<option value="'.$options['tryb_pracy_id'].'">'.$options['tryb_pracy'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex">
                        <button type="button" class="btn btn-primary mx-auto w-100 d-block" onclick="search()"><i class="bi bi-search"></i>Szukaj</button>
                        <button type="reset" class="btn btn-secondary ms-1">Wyczyść</button>
                    </div>
                </div>
            </form>
        </div>

        <hr>

        <h3 class="text-primary">Oferty</h3>
        <div class="row gy-2" id="offers">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/offer/get_offers.php'); ?>
        </div>
    </div>

    <script src="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/js/offers.js"?>"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</body>
</html>