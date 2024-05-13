<?php  
    require_once($_SERVER['DOCUMENT_ROOT'].'/gwork/database.php');

    $where = "";

    if(isset($_POST['keyword']) && isset($_POST['location'])){
        $offers_query = "SELECT * FROM ogloszenie JOIN firma USING(firma_id) WHERE LOWER(stanowisko) LIKE :keyword 
            AND (LOWER(ogloszenie_adres) LIKE :location OR LOWER(ogloszenie_kod_pocztowy) LIKE :location OR LOWER(ogloszenie_miasto) LIKE :location)";

        if(is_numeric($_POST['category']) && $_POST['category'] > 0){
            $where .= " AND kategoria_id = {$_POST['category']}";
        }
        if(is_numeric($_POST['job_level']) && $_POST['job_level'] > 0){
            $where .= " AND poziom_stanowiska_id = {$_POST['job_level']}";
        }
        if(is_numeric($_POST['concract_type']) && $_POST['concract_type'] > 0){
            $where .= " AND rodzaj_umowy_id = {$_POST['concract_type']}";
        }
        if(is_numeric($_POST['working_time']) && $_POST['working_time'] > 0){
            $where .= " AND wymiar_pracy_id = {$_POST['working_time']}";
        }
        if(is_numeric($_POST['work_mode']) && $_POST['work_mode'] > 0){
            $where .= " AND tryb_pracy_id = {$_POST['work_mode']}";
        }
        
        $keyword = $_POST['keyword'];
        $location = $_POST['location'];
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $offers = $db->prepare($offers_query.$where);
        $offers->bindValue(':keyword', mb_strtolower("%$keyword%"), PDO::PARAM_STR);
        $offers->bindValue(':location', mb_strtolower("%$location%"), PDO::PARAM_STR);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    else
        $offers = $db->prepare("SELECT * FROM ogloszenie JOIN firma USING(firma_id)");
 
    $offers->execute();

    while($offer = $offers->fetch()){
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