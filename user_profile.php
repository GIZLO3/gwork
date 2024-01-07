<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twój profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container px-5">
            <a class="navbar-brand fs-4" href="index.php">Gwork</a>
            <button class="navbar-toggler ms-auto me-1" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="nav expander">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="nav">  
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a type="button" class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" id="account_dropdown" aria-haspopop="true"><i class="bi bi-person-circle"></i> Konto użytkownika</a>
                        <div aria-labbeledby="account_dropdown" class="dropdown-menu p-3">
                            <form method="post" action="">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="login" placeholder="Login" name="login">
                                    <label for="login">Login</label>
                                </div>
                                <div class="form-floating my-3">
                                    <input type="password" class="form-control" id="password" placeholder="Hasło" name="password">
                                    <label for="password">Hasło</label>
                                </div>         
                                <button type="submit" class="btn btn-primary d-block m-auto" id="login_button">Zaloguj się</button>
                            </form>
                            <a class="dropdown-item mt-3" href="user_profile.php">Nie masz konta? <span class="text-primary">Zarejestruj się</span></a></p>
                        </div>
                    </li>
                </ul>
            </div>   
        </div>       
    </nav>

    <div class="container mt-5">
        <div class="row gy-2">
            <div class="col-sm-12 col-md-5">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <div class="d-flex">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="" class="img-fluid" style="max-height: 90px; border-radius: 100%;"></a>
                        <div class="d-flex flex-column justify-content-center ms-1">
                            <span class="fw-bold fs-5">Imię Nazwisko</span>
                            <span>email@email.email</span>
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

            <div class="col-12">
                <div class="rounded bg-white shadow-sm w-100 p-3">
                    <h5>Aktualne stanowisko pracy</h5>
                    <span>brak</span>
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