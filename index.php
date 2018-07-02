<?php
ob_start();


// CONFIG
require('config.php');


// PROVERA SESIJE
require ('session_check.php');


// ***
// TREBALO JE JEDNOSTAVNIJE: ZA SVAKU STRANU NAPRAVIS POSEBAN PHP (NJIH NE MOZE DA BUDE MNOGO I NE MENJAJU SE CESTO), I KADA KLIKNES NA NJU TAKO JE I POZIVAS. SVAKA STRANA MOZE DA IZGLEDA DRUGACIJE. I NA SVAKOJ BI STRANICI ONDA MOGAO ISTI KOD: IF SESIJA, IF GET, HEADERI, NAVIGACIJA I SLICNO...
// cak i klasa koja nije abstract ili interface moze da se ekstenduje i da se naslede neke njene osobine.
// u bazi koristi npr uskladistene procedure za count redova i druge operacije (a narocito za trivijalne stvari kao sto je count redova), brze je i bezbednije... ne ostavljaj to php aplikaciji.
// ***

$polje=new DatabaseFetch();
$brojKategorija=$polje->returnTableNumberRows('categories',1,1);


// PROVERA $_GET
if( (isset($_GET['p']) && !is_numeric($_GET['p'])) ){
    die("Oops, something's gone wrong");
}else{
    if(isset($_GET['p'])){
        $strana = $_GET['p'];
        // PROVERA DA LI $_GET['p'] UOPSTE POSTOJI U BAZI
        if($strana<1 || $strana>$brojKategorija){
            die("Oops, something's gone wrong");
        }
        // PROVERERA DA LI $_GET['P'] PRIPADA TIPU STRANE KOJI SE NALAZI U GORNJEM LEVOM UGLU NAVIGACIJE, A TO SU 1 i 5.
        $tipStrane = $polje->returnValueByColumn('categories','tip','category_id',$strana);
        $allowedPages = [1,5];
        if( !in_array($tipStrane,$allowedPages) ){
            die("Oops, something's gone wrong");
        }
    }else{
        $strana='1';
    }
}


// KADA JE SVE PRETHODNO U REDU, UCITAVAMO HEAD
Header::addHeader($polje->returnValueByColumn('categories','tab_name','category_id',$strana),'');
ob_end_flush();


// NAVIGATION
$navigation = new Navigation();
$navigation->addNavigation($brojKategorija,$polje,@$_SESSION['username'],$statusKorisnika,$sessionWhiteList);


// MAIN
Main::openMain();
    Main::addMainContent($polje,$strana,$_SESSION['status_korisnika']);
Main::closeMain();


// SIDEBAR, FOOTER NE PRIKAZUJEMO ADMINU
if( $_SESSION['status_korisnika'] != $sessionWhiteList[2] ){
    require('sidebar.php');
    require('footer.php');
}
