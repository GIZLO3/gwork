<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    session_start();
        
    if(isset($_GET['id'])){
        $query = $db->prepare("SELECT * FROM uzytkownik WHERE uzytkownik_id = :uzytkownik_id");
        $query->bindValue(':uzytkownik_id', $_GET['id'], PDO::PARAM_INT);
        $query->execute();
        $account = $query->fetch();

        if($account != null){
            if($account['firma_id'] != null){
                header('Location: '.$protocol.$_SERVER['HTTP_HOST'].'/gwork/firm/firm.php?id='.$account['firma_id']);
            }
    
            $query = $db->prepare("SELECT * FROM uzytkownik_informacje WHERE informacje_id = :informacje_id");
            $query->bindValue(':informacje_id', $account['informacje_id'], PDO::PARAM_INT);
            $query->execute();
            $detailed_info = $query->fetch();
        }
        else{
            redirectToPreviousPage();
        }
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
    <title>Gwork | Twój profil</title>
    <link rel="stylesheet" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/style.css"?>">
</head>
<body class="bg-light">
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/create_navbar.php');?>

    <div class="container mt-5">
        <div class="row gy-2">
            <div class="col-sm-12 col-md-5">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <div class="d-flex">
                        <img src="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork".$detailed_info['zdjecie_profilowe']?>" alt="zdjęcie_profilowe" class="img-fluid" style="height: 90px; width: 90px; border-radius: 100%;"></a>
                        <div class="d-flex flex-column justify-content-center ms-1">
                            <span class="fw-bold fs-5"><?=$detailed_info['imie'].' '.$detailed_info['nazwisko']?></span>
                            <span><?=$account['email']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <div class="row" style="height: 90px;">
                        <div class="col-12">
                            <div class="d-flex flex-column justify-content-center h-100">
                                <span><i class="bi bi-telephone fw-bold"></i> Nr telefonu:  <?=$detailed_info['numer_telefonu']?></span> 
                                <span><i class="bi bi-calendar"></i> Data urodzenia: <?=$detailed_info['data_urodzenia']?></span> 
                                <span><i class="bi bi-house"></i> Miejsce zamieszkania: <?=$detailed_info['adres'].' '.$detailed_info['kod_pocztowy'].' '.$detailed_info['miasto']?></span>
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_SESSION['is_logged_id'])){
                if($account['uzytkownik_id'] == $_SESSION['is_logged_id'])
                    echo '<div class="col-md-9">';
                else
                    echo '<div class="col-md-12">';
            }
            else
                echo '<div class="col-md-12">';

            echo'
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Aktualne stanowisko pracy</h5>
                    <span>'.$detailed_info['stanowisko_pracy'].'</span>
                </div>
            </div>';
            if(isset($_SESSION['is_logged_id']))
            {
                if($account['uzytkownik_id'] == $_SESSION['is_logged_id']){
                    echo '
                    <div class="col-md-3">
                        <div class="d-flex flex-column align-items-center justify-content-center rounded bg-white shadow-sm w-100 h-100 p-3">
                            <a class="text-dark" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/user_profile/edit_detailed_informations.php"><i class="bi bi-pencil-square"></i> Edytuj Informacje</a>
                            <a class="text-dark" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/user_profile/edit_informations.php?id='.$account['uzytkownik_id'].'"><i class="bi bi-pencil-square"></i> Edytuj Email/Hasło</a>
                        </div>
                    </div>';
                }
            }
            ?>
            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Podsumowanie zawodowe </h5>
                    <ul class="list-group list-group-flush">
                        <?php
                            $ocupation_summary = json_decode($detailed_info['podsumowanie_zawodowe']);

                            for($i = 0; $i < count($ocupation_summary); $i++){
                                echo '
                                <li class="list-group-item">
                                    '.$ocupation_summary[$i].'
                                </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Doświadczenie zawodowe</h5>
                    <ul class="list-group list-group-flush">
                        <?php
                            $work_experience = json_decode($detailed_info['doswiadczenie_zawodowe']);

                            for($i = 0; $i < count($work_experience); $i++){
                                echo '
                                <li class="list-group-item">
                                    '.$work_experience[$i].'
                                </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Znajomość języków </h5>
                    <ul class="list-group list-group-flush">
                        <?php
                            $languages = json_decode($detailed_info['jezyki']);

                            for($i = 0; $i < count($languages); $i++){
                                echo '
                                <li class="list-group-item">
                                    '.$languages[$i].'
                                </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Umiejętności</h5>
                    <ul class="list-group list-group-flush">
                        <?php
                            $skills = json_decode($detailed_info['umiejetnosci']);

                            for($i = 0; $i < count($skills); $i++){
                                echo '
                                <li class="list-group-item">
                                    '.$skills[$i].'
                                </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Kursy, szkolenia, certyfikaty </h5>
                    <ul class="list-group list-group-flush">
                        <?php
                            $courses = json_decode($detailed_info['kursy']);

                            for($i = 0; $i < count($courses); $i++){
                                echo '
                                <li class="list-group-item">
                                    '.$courses[$i].'
                                </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <a class="fs-5 text-decoration-none" data-bs-toggle="collapse" href="#collapseCV" role="button" aria-expanded="false" aria-controls="collapseCV">
                        CV
                    </a>
                    <div class="collapse" id="collapseCV">
                        <div class="card card-body">
                            <img src="https://images.surferseo.art/7389a9c0-22e7-4c7b-85b0-39720467f91d.jpeg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-5">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Linki </h5>
                    <div class="d-flex" style="gap: 10px;">
                        <span>Link: <a href="#">Link</a></span>
                        <span>Link: <a href="#">Link</a></span>
                        <span>Link: <a href="#">Link</a></span>
                        <span>Link: <a href="#">Link</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</body>
</html>