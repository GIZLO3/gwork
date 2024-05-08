<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    session_start();

    if(!isset($_SESSION['is_logged_login'])){
        if(isset($_SERVER["HTTP_REFERER"])) 
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        else
            header('Location: '.$protocol.$_SERVER['HTTP_HOST'].'/gwork/index.php');
    }

    $query = $db->prepare("SELECT * FROM uzytkownik JOIN uzytkownik_informacje USING(informacje_id) WHERE uzytkownik_id = :uzytkownik_id");
    $query->bindValue(':uzytkownik_id', $_SESSION['is_logged_id'], PDO::PARAM_INT);
    $query->execute();
    $informations = $query->fetch();

    if(isset($_POST['phone_number']))
    {
        $succes = true;

        $firstname = $_POST['firstname'];
        if(!empty($_POST['firstname']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $firstname) || mb_strlen($firstname) > 100){
                $succes = false;
                $_SESSION['firstname_error'] = "Imię posiada niedozwolone znaki specjane!"; 
            }
        }
        else
            $firstname = null;

        $surname = $_POST['surname'];
        if(!empty($_POST['surname']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $surname) || mb_strlen($surname) > 150){
                $succes = false;
                $_SESSION['surname_error'] = "Nazwisko posiada niedozwolone znaki specjane!"; 
            }
        }
        else
            $surname = null;

        $phone_number = $_POST['phone_number'];
        if(!empty($_POST['phone_number']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $phone_number) || strlen($phone_number) != 9){
                $succes = false;
                $_SESSION['phone_number_error'] = "Niepoprawny numer telefonu!";
            }
        }
        else
            $phone_number = null;

        $birth_date = $_POST['birth_date'];
        if(empty($_POST['birth_date']))
            $birth_date = null;

        $address = $_POST['address'];
        if(!empty($_POST['address']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $address)){
                $succes = false;
                $_SESSION['address_error'] = "Adres posiada niedozwolone znaki specjane!"; 
            }
        }
        else
            $address = null;


        $postal_code = $_POST['postal_code'];
        if(!empty($_POST['address']))
        {
            if(!preg_match('/^[0-9]{2}-?[0-9]{3}$/', $postal_code)){
                $succes = false;
                $_SESSION['postal_code_error'] = "Niepoprawny kod pocztowy!";
            }
        }
        else
            $postal_code = null;

        $city = $_POST['city'];
        if(!empty($_POST['city']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $city)){
                $succes = false;
                $_SESSION['address_error'] = "Miasto posiada niedozwolone znaki specjane!"; 
            }
        }
        else
            $city = null;

        $ocupation = $_POST['ocupation'];
        if(!empty($_POST['ocupation']))
        {
            if(!preg_match("/^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9\\s]*$/u", $ocupation)){
                $succes = false;
                $_SESSION['address_error'] = "Niedozwolone znaki specjane!"; 
            }
        }
        else
            $ocupation = null;

        $ocupation_summary = array();
        $i = 0;
        while(isset($_POST['ocupation_summary'.$i])){
            if(!empty($_POST['ocupation_summary'.$i]))
                array_push($ocupation_summary, $_POST['ocupation_summary'.$i]);
            $i++;
        }   

        $work_experience = array();
        $i = 0;
        while(isset($_POST['work_experience'.$i])){
            if(!empty($_POST['work_experience'.$i]))
                array_push($work_experience, $_POST['work_experience'.$i]);
            $i++;
        } 

        $languages = array();
        $i = 0;
        while(isset($_POST['languages'.$i])){
            if(!empty($_POST['languages'.$i]))
                array_push($languages, $_POST['languages'.$i]);
            $i++;
        } 

        $skills = array();
        $i = 0;
        while(isset($_POST['skills'.$i])){
            if(!empty($_POST['skills'.$i]))
                array_push($skills, $_POST['skills'.$i]);
            $i++;
        } 

        $courses = array();
        $i = 0;
        while(isset($_POST['courses'.$i])){
            if(!empty($_POST['courses'.$i]))
                array_push($courses, $_POST['courses'.$i]);
            $i++;
        } 


        if($succes)
        {
            $query = $db->prepare("UPDATE uzytkownik_informacje SET imie = :imie, nazwisko = :nazwisko, numer_telefonu = :numer_telefonu, data_urodzenia = :data_urodzenia, adres = :adres, kod_pocztowy = :kod_pocztowy, miasto = :miasto, 
                stanowisko_pracy = :stanowisko_pracy, 
                podsumowanie_zawodowe= :podsumowanie_zawodowe,
                doswiadczenie_zawodowe = :doswiadczenie_zawodowe,
                jezyki = :jezyki,
                umiejetnosci = :umiejetnosci,
                kursy = :kursy
                WHERE informacje_id = :informacje_id");
            $query->execute(array(
                ':imie' => $firstname,
                ':nazwisko' => $surname,
                ':numer_telefonu' => $phone_number,
                ':data_urodzenia' => $birth_date,
                ':adres' => $address,
                ':kod_pocztowy' => $postal_code,
                ':miasto' => $city,
                ':stanowisko_pracy' => $ocupation,
                ':podsumowanie_zawodowe' => json_encode($ocupation_summary),
                ':doswiadczenie_zawodowe' => json_encode($work_experience),
                ':jezyki' => json_encode($languages),
                ':umiejetnosci' => json_encode($skills),
                ':kursy' => json_encode($courses),
                ':informacje_id' => $_SESSION['is_logged_info_id']
            ));

            header('Location: '.$protocol.$_SERVER['HTTP_HOST'].'/gwork/index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwork | Edytuj profil</title>
    <link rel="stylesheet" href="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/style.css"?>">
</head>
<body class="bg-light">
    <form action="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/user_profile/edit_detailed_informations.php"?>" method="post">
        <div class="container mt-4">
            <div class="row gy-2">
                <div class="col-sm-12 col-md-5">
                    <div class="rounded bg-white shadow-sm w-100 h-100 p-3">
                        <div class="d-flex align-items-center h-100">
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="" class="img-fluid me-2" style="max-height: 90px; border-radius: 100%;"></a>
                            <div class="d-flex flex-column justify-content-center ms-1">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Imię" value="<?=$informations['imie']?>">
                                        <label for="firstname">Imię</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Nazwisko" value="<?=$informations['nazwisko']?>">
                                        <label for="surname">Nazwisko</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="rounded bg-white shadow-sm w-100 p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-column justify-content-center h-100">
                                    <div class="input-group">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Nr telefonu" value="<?=$informations['numer_telefonu']?>">
                                            <label for="phone_number">☎Nr telefonu</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Data urodzenia" value="<?=$informations['data_urodzenia']?>">
                                            <label for="birth_date">📅Data urodzenia</label>
                                        </div>
                                    </div>
                                    <div class="form-floating mt-1">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Adres" value="<?=$informations['adres']?>">
                                            <label for="address">🏠Adres</label>
                                        </div>
                                    <div class="input-group mt-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Kod pocztowy" value="<?=$informations['kod_pocztowy']?>">
                                            <label for="postal_code">📩Kod pocztowy</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="city" name="city" placeholder="Miasto" value="<?=$informations['miasto']?>"> 
                                            <label for="city">🏙Miasto</label>
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="rounded bg-white shadow-sm w-100 h-100 p-3">
                        <h5>Aktualne stanowisko pracy</h5>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="ocupation" name="ocupation" placeholder="Stanowisko pracy" value="<?=$informations['stanowisko_pracy']?>">
                            <label for="ocupation">Stanowisko pracy</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="rounded bg-primary shadow-sm w-100 h-100 p-3 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary w-100 h-100">Edytuj dane</button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="rounded bg-white shadow-sm w-100 h-100 p-3">
                        <h5>Podsumowanie zawodowe </h5> 
                        <ul class="list-group list-group-flush" id="ocupation_summary">
                            <?php
                                $ocupation_summary = json_decode($informations['podsumowanie_zawodowe']);

                                for($i = 0; $i < count($ocupation_summary); $i++){
                                    echo '
                                    <li class="list-group-item">
                                        <input type="text" class="form-control" name="ocupation_summary'.$i.'" value="'.$ocupation_summary[$i].'">
                                    </li>';
                                }
                            ?>
                        </ul>

                        <button type="button" class="btn btn-primary d-block ms-auto me-3" onclick="addInputToGroupList('ocupation_summary')"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="rounded bg-white shadow-sm w-100 h-100 p-3">
                        <h5>Doświadczenie zawodowe</h5>
                        <ul class="list-group list-group-flush" id="work_experience">
                            <?php
                                $work_experience = json_decode($informations['doswiadczenie_zawodowe']);

                                for($i = 0; $i < count($work_experience); $i++){
                                    echo '
                                    <li class="list-group-item">
                                        <input type="text" class="form-control" name="work_experience'.$i.'" value="'.$work_experience[$i].'">
                                    </li>';
                                }
                            ?>
                        </ul>

                        <button type="button" class="btn btn-primary d-block ms-auto me-3" onclick="addInputToGroupList('work_experience')"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="rounded bg-white shadow-sm w-100 h-100 p-3">
                        <h5>Znajomość języków </h5>
                        <ul class="list-group list-group-flush" id="languages">
                            <?php
                                $languages = json_decode($informations['jezyki']);

                                for($i = 0; $i < count($languages); $i++){
                                    echo '
                                    <li class="list-group-item">
                                        <input type="text" class="form-control" name="languages'.$i.'" value="'.$languages[$i].'">
                                    </li>';
                                }
                            ?>
                        </ul>

                        <button type="button" class="btn btn-primary d-block ms-auto me-3" onclick="addInputToGroupList('languages')"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="rounded bg-white shadow-sm w-100 h-100 p-3">
                        <h5>Umiejętności</h5>
                        <ul class="list-group list-group-flush" id="skills">
                            <?php
                                $skills = json_decode($informations['umiejetnosci']);

                                for($i = 0; $i < count($skills); $i++){
                                    echo '
                                    <li class="list-group-item">
                                        <input type="text" class="form-control" name="skills'.$i.'" value="'.$skills[$i].'">
                                    </li>';
                                }
                            ?>
                        </ul>

                        <button type="button" class="btn btn-primary d-block ms-auto me-3" onclick="addInputToGroupList('skills')"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="rounded bg-white shadow-sm w-100 h-100 p-3">
                        <h5>Kursy, szkolenia, certyfikaty </h5>
                        <ul class="list-group list-group-flush" id="courses">
                            <?php
                                $courses = json_decode($informations['kursy']);

                                for($i = 0; $i < count($courses); $i++){
                                    echo '
                                    <li class="list-group-item">
                                        <input type="text" class="form-control" name="courses'.$i.'" value="'.$courses[$i].'">
                                    </li>';
                                }
                            ?>
                        </ul>

                        <button type="button" class="btn btn-primary d-block ms-auto me-3" onclick="addInputToGroupList('courses')"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="rounded bg-white shadow-sm w-100 h-100 p-3">
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
    </form>

    <script src="<?=$protocol.$_SERVER['HTTP_HOST']."/gwork/js/edit_user_detailed_informations.js"?>"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</body>
</html>