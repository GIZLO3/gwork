<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');
    
    echo '
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container px-5">
            <a class="navbar-brand fs-4 me-4" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/index.php">Gwork</a>
            <button class="navbar-toggler ms-auto me-1" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="nav expander">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">  
                <ul class="navbar-nav mt-1 fs-5">
                    <li class="nav-item">
                        <a class="text-dark text-decoration-none" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/offer/offers.php">Oferty</a>
                    </li>
                </ul>  
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown fs-5">';
                        if(!isset($_SESSION['is_logged_login']))
                        {
                            echo'
                            <a type="button" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" id="account_dropdown" aria-haspopop="true"><i class="bi bi-person-circle"></i> Konto</a>
                            <div aria-labbeledby="account_dropdown" class="dropdown-menu p-3">
                                <form method="post" action="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/login.php">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="login" placeholder="Login" name="login">
                                        <label for="login">Login/Email</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="password" class="form-control" id="password" placeholder="Hasło" name="password">
                                        <label for="password">Hasło</label>
                                    </div>';
                                    
                                    if(isset($_SESSION['login_error']))
                                    {
                                        echo '<p class="text-danger">'.$_SESSION['login_error'].'</p>';
                                        unset($_SESSION['login_error']);
                                    }
                                    
                                    echo'
                                    <button type="submit" class="btn btn-primary d-block m-auto" id="login_button">Zaloguj się</button>
                                </form>
                                <a class="dropdown-item mt-3" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/register.php">Nie masz konta? <span class="text-primary">Zarejestruj się</span></a></p>
                            </div>';
                        }
                        else if(isset($_SESSION['is_logged_firm_id']))
                        {
                            echo'
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" 
                            id="account_dropdown" aria-haspopop="true"><i class="bi bi-person-circle"></i> '.$_SESSION['is_logged_login'].'</a>
                            <div class="dropdown-menu p-2 text-center fs-5">            
                                <a class="dropdown-item my-2" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/firm/firm.php?id='.$_SESSION['is_logged_firm_id'].'"><i class="bi bi-person"></i>Profil firmy</a>
                                <a class="dropdown-item my-2" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/firm/add_offer.php"><i class="bi bi-card-checklist"></i> Dodaj ogłoszenie</a>
                                <hr class"dropdown-divider">
                                <a class="dropdown-item my-2" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/logout.php"><i class="bi bi-box-arrow-right"></i> Wyloguj się</a>
                            </div>';
                        }
                        else
                        {
                            echo'
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" 
                            id="account_dropdown" aria-haspopop="true"><i class="bi bi-person-circle"></i> '.$_SESSION['is_logged_login'].'</a>
                            <div class="dropdown-menu p-2 text-center fs-5">            
                                <a class="dropdown-item my-2" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/user_profile/user_profile.php?id='.$_SESSION['is_logged_id'].'"><i class="bi bi-person"></i> Moje konto</a>
                                <a class="dropdown-item my-2" href=""><i class="bi bi-card-checklist"></i> Coś</a>
                                <hr class"dropdown-divider">
                                <a class="dropdown-item my-2" href="'.$protocol.$_SERVER['HTTP_HOST'].'/gwork/logout.php"><i class="bi bi-box-arrow-right"></i> Wyloguj się</a>
                            </div>';
                        }
                    echo'
                    </li>
                </ul>
            </div>   
        </div>       
    </nav>';