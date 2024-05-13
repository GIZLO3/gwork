<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    if(isset($_GET['id'])){
        $query = $db->prepare("SELECT * FROM firma WHERE firma_id = :firma_id");
        $query->bindValue(':firma_id', $_GET['id'], PDO::PARAM_INT);
        $query->execute();
        $firm = $query->fetch();

        if($firm == null)
            redirectToPreviousPage();
    }
    else{
        redirectToPreviousPage();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwork | <?=$firm['nazwa']?></title>
    <link rel="stylesheet" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/style.css"?>">
</head>
<body class="bg-light">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/create_navbar.php');?>

    <div class="container mt-5">
        <div class="d-flex align-items-end">
            <div style="height: 160px !important">
                <img src="<?=$protocol.$_SERVER['HTTP_HOST'].'/gwork'.$firm['logo']?>" alt="<?=$firm['nazwa']?>" class="h-100 rounded me-2">
            </div> 
            <div class="d-flex justify-content-between align-items-end border-bottom border-2 w-100">
                <span class="fs-2 fw-bold"><?=$firm['nazwa']?></span>
                <?php
                    if(isset($_SESSION['is_logged_firm_id'])){
                        if($firm['firma_id'] == $_SESSION['is_logged_firm_id']){
                            echo '<div class="d-flex flex-column">';
                                echo '<a class="text-dark" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/firm/edit_firm.php?id='.$firm['firma_id'].'"><i class="bi bi-pencil-square"></i>Edytuj dane</a>';
                                echo '<a class="text-dark" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/user_profile/edit_informations.php?id='.$_SESSION['is_logged_id'].'"><i class="bi bi-pencil-square"></i> Edytuj Email/Hasło</a>';
                            echo '</div>';
                        }
                        
                    }
                ?>
            </div>
        </div>

        <div class="row mt-4 g-3">
            <div class="col-md-6">
                <div class="d-flex flex-column mx-auto bg-white rounded shadow p-4 text-center" style="max-width: 500px;">
                    <span class="fw-bold"><?=$firm['nazwa']?></span>
                    <span><?=$firm['adres']?></span>
                    <span><?=$firm['kod_pocztowy'].' '.$firm['miasto']?></span>
                    <span>NIP: <span><?=$firm['nip']?></span></span>
                    <span>tel.: <span><?=$firm['telefon']?></span></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex flex-column justify-content-center mx-auto bg-white rounded shadow p-4 text-center h-100" style="max-width: 500px;">
                    <span class="fw-bold">Ilość Ofert Tej Firmy</span>
                    <?php
                        $query = $db->prepare("SELECT COUNT(*) FROM ogloszenie WHERE firma_id = :firma_id");
                        $query->bindValue(':firma_id', $_GET['id'], PDO::PARAM_INT);
                        $query->execute();
                        $offers_count = $query->fetch();
                        echo '<span class="text-primary fw-bold fs-1">'.$offers_count['COUNT(*)'].'</span>';
                    ?>
                </div>
            </div>
        </div>
        
        <div class="row mt-5 gy-2">
            <div class="col-12">
                <span class="fs-3 fw-bold">Dostępne Oferty:</span>
            </div>
            <?php
                $query = $db->prepare("SELECT * FROM ogloszenie WHERE firma_id = :firma_id");
                $query->bindValue(':firma_id', $_GET['id'], PDO::PARAM_INT);
                $query->execute();

                while($offer = $query->fetch()){
                    echo'
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <a class="text-dark text-decoration-none" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/offer.php?id='.$offer['ogloszenie_id'].'">
                                <div class="rounded bg-white shadow-sm w-100 h-100 p-2 d-flex flex-column justify-content-center">
                                    <div class="d-flex">
                                        <span class="fw-bold text-wrap">'.$offer['stanowisko'].'</span>
                                    </div>
                                    <span class="fw-bold text-secondary">'.$offer['wynagrodzenie_od'].'-'.$offer['wynagrodzenie_do'].'zł</span>
                                    <div class="d-flex align-items-center mt-1" style="height: 65px;">
                                        <img src="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/'.$firm['logo'].'" alt="'.$firm['nazwa'].'" class="img-fluid" style="max-height: 70px">
                                        <div class="d-flex flex-column ms-1">
                                            <span>'.$firm['nazwa'].'</span>
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
        
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</body>
</html>