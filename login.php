<?php
// OTVARAM OUTPUT_BUFFERING ZBOG RETURNA FUNKCIJE GET VARIJABLE U INTERFEJSU ISignupLogin
ob_start();
require ('config.php');


$login=new Login();
session_start();
session_write_close();


//PROVERAVAM DA LI JE SUBMITOVAN LOGIN
if(isset($_POST['submit'])) {

    // PROVERA SLAGANJA TOKENA
    $postNiz=$_POST;
    if( !isset($postNiz['token']) || !isset($_SESSION['token']) || $_SESSION['token'] != $postNiz['token']){
        die("Oops, something's gone wrong.");
    }

    // SET (htmlspecialchars encodovanje) I GET UNETIH VARIJABLI IZ LOGINA. $USERNAME JE SADA BEZBEDAN ZA PHP APLIKACIJU
    setVariables($postNiz,$login);
    $username=$login->getVariable('username');
    $password=$login->getVariable('password');

    if($username == ADMIN_USER && $password == ADMIN_PASS){

//      dozvola admin logina samo odredjenim IP-evima.
//      if( !in_array($_SERVER['REMOTE_ADDR'],$allowedIPs) ){
//          die("Oops, something's gone wrong.");
//      }

        // REGENERISANJE PHPSESSID NAKON USPESNOG ADMIN LOGINA, SMESTANJE ADMINA U SESIJU I REDIREKCIJA NA POCETNU STRANU
        session_start();
            session_regenerate_id(true);
            // AKO JE SETOVAN 'REMEMBER ME' NEKA TRAJE SAT VREMENA
            if( isset($_POST['checkbox']) ){
                setcookie('user',$username,time()+3600);
                setcookie('pass',password_hash($password,PASSWORD_BCRYPT),time()+3600);
            }
            $_SESSION['status_korisnika']=$sessionWhiteList[2];
        session_write_close();
        Login::redirect('index.php');

    }else{
        // AKO NIJE ADMIN, ONDA PROVERI USERA I URADI ISTO KAO ADMINU
        $userFound = $login->matchUser($username,$password);
        if($userFound){
            session_start();
                session_regenerate_id(true);
                // AKO JE SETOVAN 'REMEMBER ME' NEKA TRAJE SAT VREMENA
                if( isset($_POST['checkbox']) ){
                    setcookie('user',$username,time()+3600);
                    setcookie('pass',password_hash($password,PASSWORD_BCRYPT),time()+3600);
                }
                $_SESSION['status_korisnika'] = $sessionWhiteList[1];
                // SESIJA USERNAME JE BEZBEDNA ZA PHP APLIKACIJU, JER JE I DALJE htmlspecialchars
                $_SESSION['username'] = $username;
            session_write_close();
            Login::redirect('index.php');
        }else{
            // AKO NESTO NIJE DOBRO, VRATI NA POPUNJAVANJE FORME I EMITUJ PORUKU ISPOD
            returnPage($login);
            echo $login->checkYourInput;
        }
    }


}else{
    returnPage($login);
}


function setVariables($postNiz,$login){
    // PRETVARAM U JSON DA BIH MOGAO DA PRENESEM U METODU, A U SAMOJ METODI DEKODIRAM.
    $postNiz=json_encode($postNiz);
    $login->setVariables($postNiz);
}

function returnPage($login){

    global $token;
    global $statusKorisnika;
    global $sessionWhiteList;
    $polje=new DatabaseFetch();
    $brojKategorija=$polje->returnTableNumberRows('categories',1,1);
    $token=md5(microtime().uniqid());


    // PROVERA SESIJE
    require ('session_check.php');


    // UCITAVANJE HEADERA
    $tabName = $polje->returnValueByColumn('categories','tab_name','category_id',3);
    Header::addHeader($tabName,'login');
    ob_end_flush();


    // NAVIGACIJA
    $navigation = new Navigation();
    $navigation->addNavigation($brojKategorija,$polje,@$_SESSION['username'],$statusKorisnika,$sessionWhiteList);


    // FORMA
    $login->openFormTag('post','#');
        $login->postaviSadrzajForme('Username:','text','username','','required','required','45');
        $login->postaviSadrzajForme('Password:','password','password','','required','required','50');
        echo "<input type='hidden' name='token' value=" . $token . ">";
        echo "<br><input type='checkbox' name='checkbox'> Remember me";
        $login->postaviSadrzajForme('&nbsp','submit','submit','Login','','','');
    $login->closeFormTag();
}