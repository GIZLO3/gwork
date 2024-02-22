<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/gtech/database.php');

    echo '
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
    </nav>';