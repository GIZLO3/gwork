<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    session_start();

    if(isset($_GET['id'])){
        $query = $db->prepare("SELECT * FROM uzytkownik WHERE uzytkownik_id = :uzytkownik_id");
        $query->bindValue(':uzytkownik_id', $_GET['id'], PDO::PARAM_INT);
        $query->execute();
        $account = $query->fetch();
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
    <?php require_once('create_navbar.php')?>

    <div class="container mt-5">
        <div class="row gy-2">
            <div class="col-sm-12 col-md-5">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <div class="d-flex">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="" class="img-fluid" style="max-height: 90px; border-radius: 100%;"></a>
                        <div class="d-flex flex-column justify-content-center ms-1">
                            <span class="fw-bold fs-5">Imię Nazwisko</span>
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
                                <span><i class="bi bi-telephone fw-bold"></i> Nr telefonu:  +48 123 123 123</span> 
                                <span><i class="bi bi-calendar"></i> Data urodzenia: ??.??.????</span> 
                                <span><i class="bi bi-house"></i> Miejsce zamieszkania: ul. ?????? ??, ??-??? ????????</span>
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Aktualne stanowisko pracy</h5>
                    <span>brak</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex flex-column align-items-center justify-content-center rounded bg-white shadow-sm w-100 h-100 p-3">
                    <a class="text-dark" href="">Edytuj Informacje</a>
                    <a class="text-dark" href="">Edytuj Email/Hasło</a>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Podsumowanie zawodowe </h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                        <li class="list-group-item">A fourth item</li>
                        <li class="list-group-item">And a fifth one</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Doświadczenie zawodowe</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                        <li class="list-group-item">A fourth item</li>
                        <li class="list-group-item">And a fifth one</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Znajomość języków </h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                        <li class="list-group-item">A fourth item</li>
                        <li class="list-group-item">And a fifth one</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Umiejętności</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                        <li class="list-group-item">A fourth item</li>
                        <li class="list-group-item">And a fifth one</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Kursy, szkolenia, certyfikaty </h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                        <li class="list-group-item">A fourth item</li>
                        <li class="list-group-item">And a fifth one</li>
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