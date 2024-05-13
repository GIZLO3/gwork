<?php 
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwork</title>
    <link rel="stylesheet" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/style.css"?>">
</head>
<body class="bg-light">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/create_navbar.php');?>

    <div class="container">
        <div class="mt-3 p-3 d-flex flex-column align-items-center">
            <span class="fs-4"><b class="text-primary fs-3">
                <?php
                    $query = $db->prepare("SELECT COUNT(*) FROM ogloszenie");
                    $query->execute();
                    $offers_count = $query->fetch();
                    echo $offers_count['COUNT(*)'];
                ?>
            </b> sprawdzonych ofert pracy</span>
            <span class="fs-5">od najlepszych pracodawców!</span>
        </div>

        <div class="p-3 mt-2">
            <form action="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/offer/offers.php"?>" method="post">
                <div class="row gx-1 gy-2">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="keyword" placeholder="Słowo kluczowe" name="keyword">
                            <label for="keyword">Słowo kluczowe</label>
                        </div> 
                    </div>
                    <div class="col-12 col-md-2 col-lg-4">
                        <select class="form-select h-100" name="category">
                            <option selected value="0">-Katergoria-</option>
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
                                <input type="text" class="form-control" id="location" placeholder="Lokalizacja" name="location">
                                <label for="location">Lokalizacja</label>
                            </div>
                            <select class="form-select w-25" name="location_raduis">
                                <option value="0" selected>+0 km</option>
                                <option value="10">+10 km</option>
                                <option value="20">+20 km</option>
                                <option value="30">+30 km</option>
                                <option value="50">+50 km</option>
                            </select>
                        </div>                
                    </div> 
                    <div class="col-12 col-md-3">
                        <select class="form-select" name="job_level">
                            <option selected value="0">-Poziom stanowiska-</option>
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
                        <select class="form-select" name="concract_type">
                            <option selected value="0">-Rodzaj umowy-</option>
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
                        <select class="form-select" name="working_time">
                            <option selected value="0">-Wymiar pracy-</option>
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
                        <select class="form-select" name="work_mode">
                            <option selected value="0">-Tryb pracy-</option>
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
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Szukaj</button>
                        <button type="reset" class="btn btn-secondary ms-1">Wyczyść</button>
                    </div>
                </div>
            </form>
        </div>

        <hr>

        <h3 class="text-primary">Najnowsze oferty</h3>
        <div class="row gy-2">
            <?php
                $query = $db->prepare("SELECT * FROM ogloszenie JOIN firma USING(firma_id) ORDER BY ogloszenie_id DESC LIMIT 21");
                $query->execute();

                while($offer = $query->fetch()){
                    echo'
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <a class="text-dark text-decoration-none" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/offer/offer.php?id='.$offer['ogloszenie_id'].'">
                                <div class="rounded bg-white shadow-sm w-100 h-100 p-2 d-flex flex-column justify-content-evenly">
                                    <div class="d-flex">
                                        <span class="fw-bold text-wrap">'.$offer['stanowisko'].'</span>
                                    </div>
                                    <span class="fw-bold text-secondary">'.$offer['wynagrodzenie_od'].'-'.$offer['wynagrodzenie_do'].'zł</span>
                                    <div class="d-flex align-items-center mt-1" style="height: 65px;">
                                        <img src="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/'.$offer['logo'].'" alt="'.$offer['nazwa'].'" class="img-fluid" style="max-height: 70px">
                                        <div class="d-flex flex-column ms-1">
                                            <span>'.$offer['nazwa'].'</span>
                                            <span class="fs-7">'.$offer['ogloszenie_miasto'].'</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    ';
                }
            ?>
        </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</body>
</html>