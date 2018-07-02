<?php
// OTVARAM OUTPUT_BUFFERING ZBOG RETURNA FUNKCIJE GET VARIJABLE U INTERFEJSU ISignupLogin
ob_start();
require ('config.php');


$registration=new Signup();
session_start();
session_write_close();


// AKO JE SUBMITOVANA REGISTRACIJA, PRITOM NE MOZE USERNAME BITI 'ADMIN', TO JE JEDINI IZUZETAK
if( isset($_POST['submit']) && isset($_POST['username']) && $_POST['username'] != 'ADMIN' ){

    $postNiz=$_POST;
    $polje = new DatabaseFetch();

    setVariables($postNiz,$registration);
    $firstName=$registration->getVariable('firstName');
    $lastName=$registration->getVariable('lastName');
    $username=$registration->getVariable('username');
    $password=$registration->getVariable('password');
    $email=$registration->getVariable('email');
    $existingUsers=$polje->returnTableNumberRows('users','username',$username);

    if($existingUsers >= 1){
        returnPage($registration);
        echo $registration->alertUserExists;
    }else{
        $try = $registration->addUser($firstName,$lastName,$username,$password,$email);

        if(!$try){
            returnPage($registration);
            echo $registration->alertDatabaseConnectionError;
        }else{
            $signupSuccess = 'yes';
            returnPage($registration);
        }
    }

}else{
    returnPage($registration);
}


function setVariables($postNiz,$registration){
    $postNiz=json_encode($postNiz);
    $registration->setVariables($postNiz);
}


function returnPage($registration){

    global $sessionWhiteList;
    $polje=new DatabaseFetch();
    $brojKategorija=$polje->returnTableNumberRows('categories',1,1);
    global $signupSuccess;


    // PROVERA SESIJE
    require ('session_check.php');


    // HEADER
    $tabName = $polje->returnValueByColumn('categories','tab_name','category_id',2);
    Header::addHeader($tabName,'signup');
    ob_end_flush();


    // NAVIGACIJA
    $navigation = new Navigation();
    $navigation->addNavigation($brojKategorija,$polje,@$_SESSION['username'],$statusKorisnika,$sessionWhiteList);

    if($signupSuccess == 'yes'){
        echo $registration->success;
        die();
    }


    // FORMA
    $registration->openFormTag('post','#');
        $registration->postaviSadrzajForme('First name:','text','firstName','','&nbsp;','','60');
        $registration->postaviSadrzajForme('Last name:','text','lastName','','&nbsp;','','60');
        $registration->postaviSadrzajForme('Username:','text','username','','required','required','45');
        $registration->postaviSadrzajForme('Password:','password','password','','required','required','50');
        $registration->postaviSadrzajForme('email:','text','email','','&nbsp;','','100');
        $registration->postaviSadrzajForme('&nbsp','submit','submit','Submit registration','','','');
    $registration->closeFormTag();
}