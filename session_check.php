<?php

if(basename($_SERVER['PHP_SELF']) == 'session_check.php'){
    die();
}

session_start();
    // SETOVAN, A PRAZAN
    if(isset($_SESSION['status_korisnika']) && empty($_SESSION['status_korisnika'])){
        // GENERALNO SAM ZATVARAO SESIJU ODMAH KADA ZNAM DA NECU VISE UNOSITI U NJU PODATKE (ZBOG AJAX-A)
        session_write_close();
        die("Oops, something's gone wrong");
    }
    // SETOVAN, A NIJE PRAZAN
    if( isset($_SESSION['status_korisnika']) && !empty($_SESSION['status_korisnika']) ){
        if(in_array($_SESSION['status_korisnika'],$sessionWhiteList)){
            $statusKorisnika=$_SESSION['status_korisnika'];
            // MOZE DALJE
        }else{
            session_write_close();
            die("Oops, something's gone wrong");
        }
    // NIJE UOPSTE SETOVAN
    }else{
        $_SESSION['status_korisnika']=$sessionWhiteList[0];
        $statusKorisnika=$_SESSION['status_korisnika'];
        // MOZE DALJE
    }
    // AKO POSTOJI TOKEN (KOD LOGINA)
    if( isset($token) ){
        $_SESSION['token'] = $token;
    }
session_write_close();