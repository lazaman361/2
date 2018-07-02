<?php

if(basename($_SERVER['PHP_SELF']) == 'config.php'){
    die();
}

function __autoload($imeklase){
    require "classes/$imeklase.class.php";
}

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','sportisimo');
define('ADMIN_USER','admin');
define('ADMIN_PASS','123');
//$allowedIPs = ['xxx.xxx.xxx.xxx'];
$sessionWhiteList=['neulogovan_posetilac','user','administrator'];


// ODMAH SE KONEKTUJEM NA BAZU (NA POCETKU SVAKE SKRIPTE), DA NE BIH MORAO PONOVO U SAMOJ SKRIPTI ILI U KONSTRUKTORU
@Connection::connect(DB_HOST,DB_NAME,DB_USER,DB_PASS);


// PROVERAVAM DA LI JE KORISNIK SETOVAO 'REMEMBER ME' OPCIJU
if( isset($_COOKIE['user']) && isset($_COOKIE['pass']) ){
    Connection::rememberMe($_COOKIE['user'],$_COOKIE['pass'],$sessionWhiteList);
}
