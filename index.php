<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwork</title>
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
                            <a class="dropdown-item mt-3" href="#">Nie masz konta? <span class="text-primary">Zarejestruj się</span></a></p>
                        </div>
                    </li>
                </ul>
            </div>   
        </div>       
    </nav>

    <div class="container">
        <div class="mt-5 p-3 d-flex flex-column align-items-center">
            <span class="fs-4"><b class="text-primary fs-3">12 312</b> sprawdzonych ofert pracy</span>
            <span class="fs-5">od najlepszych pracodawców!</span>
        </div>

        <div class="rounded bg-white shadow-sm p-3 mt-5">
            <form action="">
                <div class="row gx-1 gy-2">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="keyword" placeholder="Słowo kluczowe" name="keyword">
                            <label for="keyword">Słowo kluczowe</label>
                        </div> 
                    </div>
                    <div class="col-12 col-md-2 col-lg-4">
                        <select class="form-select h-100" name="category">
                            <option selected>-Katergoria-</option>
                            <option value="1">IT</option>
                            <option value="2">Prawo</option>
                            <option value="3">Marketing</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="input-group">
                            <div class="form-floating w-75">
                                <input type="text" class="form-control" id="location" placeholder="Lokalizacja" name="location">
                                <label for="location">Lokalizacja</label>
                            </div>
                            <select class="form-select w-25" name="locationRaduis">
                                <option value="0" selected>+0 km</option>
                                <option value="10">+10 km</option>
                                <option value="20">+20 km</option>
                                <option value="30">+30 km</option>
                                <option value="50">+50 km</option>
                            </select>
                        </div>                
                    </div>             
                    
                    <div class="col-12 col-md-3">
                        <select class="form-select" name="">
                            <option selected>-Poziom stanowiska-</option>
                            <option value="1">praktykant/stażysta</option>
                            <option value="2">młodszy specjalista (junior)</option>
                            <option value="3">specjalista (mid)</option>
                            <option value="4">starszy specjalista (senior)</option>
                            <option value="5">ekspert</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <select class="form-select" name="">
                            <option selected>-Rodzaj umowy-</option>
                            <option value="1">o pracę</option>
                            <option value="2">o dzieło</option>
                            <option value="3">zlecenie</option>
                            <option value="4">B2B</option>
                            <option value="5">zastępstwo</option>
                            <option value="6">staż/praktyka</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <select class="form-select" name="">
                            <option selected>-Wymiar etatu-</option>
                            <option value="1">część etatu</option>
                            <option value="2">cały etat</option>
                            <option value="3">dodatkowa/tymczasowa</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <select class="form-select" name="">
                            <option selected>-Tryb pracy-</option>
                            <option value="1">stacjonarna</option>
                            <option value="2">hybrydowa</option>
                            <option value="3">zdalna</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mx-auto d-block px-5 py-2"><i class="bi bi-search"></i> Szukaj</button>
                    </div>
                </div>
            </form>
        </div>

        <h3 class="mt-5 text-primary">Najnowsze oferty</h3>
        <div class="row gy-2">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="rounded bg-white shadow-sm w-100 p-2">
                    <div class="d-flex">
                        <span class="fw-bold text-wrap">Młodszy Inżynier/Inżynier - Konstruktor Części Silnika Lotniczego</span>
                        <a href="" class="ms-auto fs-5"><i class="bi bi-heart"></i></a>
                    </div>
                    <span class="fw-bold text-secondary">8 000 - 12 000 zł</span>
                    <div class="d-flex align-items-center" style="height: 65px;">
                        <img src="https://logos.gpcdn.pl/loga-firm/16657333/ee4d0000-5df0-0015-6464-08db89cd072e_280x280.png?width=65&height=65" alt="" class="img-fluid" style="max-height: 170px"></a>
                        <div class="d-flex flex-column">
                            <span>Sieć Badawcza Łukasiewicz - Instytut Lotnictwa</span>
                            <span class="fs-7">Warszawa</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="offer.php" class="mt-3 me-auto btn btn-primary">Zobacz więcej</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="rounded bg-white shadow-sm w-100 p-2">
                    <div class="d-flex">
                        <span class="fw-bold text-wrap">Młodszy Inżynier/Inżynier - Konstruktor Części Silnika Lotniczego</span>
                        <a href="" class="ms-auto fs-5"><i class="bi bi-heart"></i></a>
                    </div>
                    <span class="fw-bold text-secondary">8 000 - 12 000 zł</span>
                    <div class="d-flex align-items-center" style="height: 65px;">
                        <img src="https://logos.gpcdn.pl/loga-firm/16657333/ee4d0000-5df0-0015-6464-08db89cd072e_280x280.png?width=65&height=65" alt="" class="img-fluid" style="max-height: 170px"></a>
                        <div class="d-flex flex-column">
                            <span>Sieć Badawcza Łukasiewicz - Instytut Lotnictwa</span>
                            <span class="fs-7">Warszawa</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="offer.php" class="mt-3 me-auto btn btn-primary">Zobacz więcej</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="rounded bg-white shadow-sm w-100 p-2">
                    <div class="d-flex">
                        <span class="fw-bold text-wrap">Młodszy Inżynier/Inżynier - Konstruktor Części Silnika Lotniczego</span>
                        <a href="" class="ms-auto fs-5"><i class="bi bi-heart"></i></a>
                    </div>
                    <span class="fw-bold text-secondary">8 000 - 12 000 zł</span>
                    <div class="d-flex align-items-center" style="height: 65px;">
                        <img src="https://logos.gpcdn.pl/loga-firm/16657333/ee4d0000-5df0-0015-6464-08db89cd072e_280x280.png?width=65&height=65" alt="" class="img-fluid" style="max-height: 170px"></a>
                        <div class="d-flex flex-column">
                            <span>Sieć Badawcza Łukasiewicz - Instytut Lotnictwa</span>
                            <span class="fs-7">Warszawa</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="offer.php" class="mt-3 me-auto btn btn-primary">Zobacz więcej</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="rounded bg-white shadow-sm w-100 p-2">
                    <div class="d-flex">
                        <span class="fw-bold text-wrap">Młodszy Inżynier/Inżynier - Konstruktor Części Silnika Lotniczego</span>
                        <a href="" class="ms-auto fs-5"><i class="bi bi-heart"></i></a>
                    </div>
                    <span class="fw-bold text-secondary">8 000 - 12 000 zł</span>
                    <div class="d-flex align-items-center" style="height: 65px;">
                        <img src="https://logos.gpcdn.pl/loga-firm/16657333/ee4d0000-5df0-0015-6464-08db89cd072e_280x280.png?width=65&height=65" alt="" class="img-fluid" style="max-height: 170px"></a>
                        <div class="d-flex flex-column">
                            <span>Sieć Badawcza Łukasiewicz - Instytut Lotnictwa</span>
                            <span class="fs-7">Warszawa</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="offer.php" class="mt-3 me-auto btn btn-primary">Zobacz więcej</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="rounded bg-white shadow-sm w-100 p-2">
                    <div class="d-flex">
                        <span class="fw-bold text-wrap">Młodszy Inżynier/Inżynier - Konstruktor Części Silnika Lotniczego</span>
                        <a href="" class="ms-auto fs-5"><i class="bi bi-heart"></i></a>
                    </div>
                    <span class="fw-bold text-secondary">8 000 - 12 000 zł</span>
                    <div class="d-flex align-items-center" style="height: 65px;">
                        <img src="https://logos.gpcdn.pl/loga-firm/16657333/ee4d0000-5df0-0015-6464-08db89cd072e_280x280.png?width=65&height=65" alt="" class="img-fluid" style="max-height: 170px"></a>
                        <div class="d-flex flex-column">
                            <span>Sieć Badawcza Łukasiewicz - Instytut Lotnictwa</span>
                            <span class="fs-7">Warszawa</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="offer.php" class="mt-3 me-auto btn btn-primary">Zobacz więcej</a>
                    </div>
                </div>
            </div>
        </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</body>
</html>