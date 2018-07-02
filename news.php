<?php

if(basename($_SERVER['PHP_SELF']) == 'news.php' && empty($_GET['n'])){
    die();
}
ob_start();
require('config.php');


// PROVERA SESIJE
require ('session_check.php');


$polje=new DatabaseFetch();
$brojKategorija=$polje->returnTableNumberRows('categories',1,1);


// PROVERA $_GET
if( preg_match('/^[a-z0-9]+$/',$_GET['n']) == false ){
    die("Oops, something's gone wrong");
}else{
    $vest=$_GET['n'];
}


// KADA JE GET U REDU, DEFINISEM TAB NAME I SLICICU ISPRED NAZIVA VESTI (opet komplikovano, bespotrebno povlacim slicicu iz baze)
if( !$tabName = $polje->returnValueByColumn('news','title','md5',$_GET['n']) ){
    die("Oops, something's gone wrong");
}


// KADA JE SVE PRETHODNO U REDU, UCITAVAMO HEAD
Header::addHeader($tabName,'');
ob_end_flush();


// NAVIGATION
$navigation = new Navigation();
$navigation->addNavigation($brojKategorija,$polje,@$_SESSION['username'],$statusKorisnika,$sessionWhiteList);


// MAIN
Main::openMain();
    $polje->printSelectedNews('news.md5',$vest,'yes',$statusKorisnika);
Main::closeMain();


// SIDEBAR I FOOTER NE PRIKAZUJEMO ADMINU
if( $_SESSION['status_korisnika'] != $sessionWhiteList[2] ){
    require('sidebar.php');
    require('footer.php');
}
