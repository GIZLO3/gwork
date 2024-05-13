<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    if(isset($_GET['id'])){
        $query = $db->prepare("SELECT * FROM ogloszenie JOIN firma USING(firma_id) JOIN kategoria USING(kategoria_id) JOIN rodzaj_umowy USING(rodzaj_umowy_id) 
            JOIN poziom_stanowiska USING(poziom_stanowiska_id) JOIN wymiar_pracy USING(wymiar_pracy_id) JOIN tryb_pracy USING(tryb_pracy_id) 
            WHERE ogloszenie_id = :ogloszenie_id");
        $query->bindValue(':ogloszenie_id', $_GET['id'], PDO::PARAM_INT);
        $query->execute();
        $offer = $query->fetch();

        if($offer == null)
            redirectToPreviousPage();

        if(isset($_GET['apply'])){
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
    else{
        redirectToPreviousPage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/style.css"?>">
    <title>Gwork | <?=$offer['stanowisko']?></title>
</head>
<body class="bg-light">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/create_navbar.php');?>

    <div class="container mt-5">
        <div class="rounded bg-white shadow-sm w-100 p-2">
            <div class="row g-1">
                <div class="col-sm-12 col-md-9">
                    <div class="d-flex">
                        <img src="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/".$offer['logo']?>" alt="<?=$offer['nazwa']?>" class="img-fluid" style="max-height: 80px">
                        <div class="d-flex flex-column justify-content-center ms-1">
                            <span class="fw-bold"><?=$offer['stanowisko']?></span>
                            <a class="text-dark" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/firm/firm.php?id=".$offer['firma_id']?>"><?=$offer['nazwa']?></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="d-flex rounded border bg-light ms-auto align-items-center justify-content-center p-3">
                        <i class="bi bi-piggy-bank-fill fs-2 me-2"></i>
                        <div class="d-flex flex-column">
                            <span class="fw-bold"><?=$offer['wynagrodzenie_od']." - ".$offer['wynagrodzenie_do']." zł"?></span>
                            <span>brutto / mies.</span>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
        <div class="rounded bg-white shadow-sm w-100 p-3 mt-2">
            <div class="row gy-2">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded bg-light border offer-details-icon-box me-1">
                            <i class="bi bi-tags fs-3 "></i>
                        </div>
                        <span>
                            <?=$offer['kategoria']?>
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded bg-light border offer-details-icon-box me-1">
                            <i class="bi bi-clipboard fs-3"></i>
                        </div>
                        <span>
                            <?=$offer['rodzaj_umowy']?>
                        </span>
                    </div> 
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded bg-light border offer-details-icon-box me-1">
                            <i class="bi bi-bar-chart fs-3"></i>
                        </div>
                        <span>
                            <?=$offer['poziom_stanowiska']?>
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded bg-light border offer-details-icon-box me-1">
                            <i class="bi bi-clock fs-3"></i>
                        </div>
                        <span>
                            <?=$offer['wymiar_pracy']?>
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded bg-light border offer-details-icon-box me-1">
                            <i class="bi bi-geo-alt fs-3"></i>
                        </div>
                        <span>
                            <?=$offer['ogloszenie_adres'].", ".$offer['ogloszenie_kod_pocztowy'].", ".$offer['ogloszenie_miasto']?>
                        </span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded bg-light border offer-details-icon-box me-1">
                            <i class="bi bi-clock-history fs-3"></i>
                        </div>
                        <span>
                            ważna do: <?=$offer['waznosc']?>
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <hr class="m-0">
                    <a href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/offer/offer.php?id=".$offer['ogloszenie_id']."&apply"?>" class="btn btn-primary px-auto py-2 d-block mt-2 <?php if(isset($_SESSION['is_logged_firm_id']) || !isset($_SESSION['is_logged_id'])) echo 'disabled'?>">Aplikuj</a>
                </div>
            </div>
        </div>
        <div class="rounded bg-white shadow-sm w-100 p-3 mt-2">
            <h5 class="fw-bold text-primary">Twój zakres obowiązków</h5>
            <ul>
                <?php
                    $duties = json_decode($offer['obowiazki']);

                    for($i = 0; $i < count($duties); $i++){
                        echo '
                        <li>
                            '.$duties[$i].'
                        </li>';
                    }
                ?>
            </ul>
        </div>
        <div class="rounded bg-white shadow-sm w-100 p-3 mt-2">
            <h5 class="fw-bold text-primary">Nasze wymagania</h5>
            <ul>
                <?php
                    $requirements = json_decode($offer['wymagania']);

                    for($i = 0; $i < count($requirements); $i++){
                        echo '
                        <li>
                            '.$requirements[$i].'
                        </li>';
                    }
                ?>
            </ul>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</body>
</html>