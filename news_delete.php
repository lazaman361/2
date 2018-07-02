<?php

require ('config.php');
session_start();
session_write_close();

if( $_SESSION['status_korisnika'] != $sessionWhiteList[2] ){
    die("Oops, something's gone wrong.");
}


$vest = $_GET['n'];
NewsManipulation::removeNews($vest);
Login::redirect('index.php');