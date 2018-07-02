<?php

class Connection{

    public static $connection=null;



    public static function connect($host,$dbname,$user,$pass){
        try {
            self::$connection=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
            return self::$connection;
        }
        catch(PDOException $e)
        {
            die ('Connection failed: ' . $e->getMessage());
        }
    }



    public static function rememberMe($cookieUser,$cookiePass,$sessionWhiteList){
        session_start();
            if( $cookieUser == ADMIN_USER && password_verify(ADMIN_PASS,$cookiePass) ){
                $_SESSION['status_korisnika'] = $sessionWhiteList[2];
            }else{
                $rememberMe = new Login();
                $rememberMe->matchUser($cookieUser,$cookiePass);
                if( $rememberMe == true ){
                    $_SESSION['status_korisnika'] = $sessionWhiteList[1];
                    $_SESSION['username'] = $cookieUser;
                }else{
                    session_write_close();
                    die("Oops, something's gone wrong.");
                }
            }
        session_write_close();
    }
}