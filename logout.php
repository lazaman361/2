<?php

require ('config.php');

session_start();
    $_SESSION=[];
    setcookie('user');
    setcookie('pass');
    session_destroy();
session_write_close();
Login::redirect('index.php');