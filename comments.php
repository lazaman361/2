<?php
require ('config.php');
session_start();
session_write_close();


$comments = new CommentsManipulation();
$navigation = new Navigation();
$polje = new DatabaseFetch();
$brojKategorija = $polje->returnTableNumberRows('categories',1,1);


// AKO JE PRITISNUTO DUGME ZA SLANJE KOMENTARA
if( isset($_POST['submit']) ){
    if( isset($_SESSION['status_korisnika']) && $_SESSION['status_korisnika'] != $sessionWhiteList[0] ){
        if( $comments->exists('news','md5',$_GET['n'],$polje) ){
            $comment = $_POST['comment'];
            $newsId = $polje->returnValueByColumn('news','news_id','md5',$_GET['n']);
            if( $_SESSION['status_korisnika'] == $sessionWhiteList[2] ){
                $userId = null;
            }else{
                $userId = $polje->returnValueByColumn('users','user_id','username',$_SESSION['username']);
            }
            $comments->addComment($newsId,$userId,$comment);
            // Login::redirect('comments.php?n=' . $_GET['n']); // ne treba ova linija kad ionako otvara istu stranicu
        }else{
            die("Oops, something's gone wrong.");
        }
    }else{
        die("Oops, something's gone wrong.");
    }
}


// DA LI U URLU POSTOJI PARAMETAR
if( isset($_GET['n']) ){
    global $comments;
    if( $comments->exists('news','md5',$_GET['n'],$polje) ){
        // MOZE DALJE
    }else{
        die("Oops, something's gone wrong.");
    }
}else{
    die("Oops, something's gone wrong.");
}


// DODELI VREDNOST SESIJI AKO NE POSTOJI
if( !isset($_SESSION['status_korisnika']) ) {
    session_start();
    $_SESSION['status_korisnika'] = $sessionWhiteList[0];
    session_write_close();
}else{
    if( !in_array($_SESSION['status_korisnika'],$sessionWhiteList) ){
        die("Oops, something'a gone wrong.");
    }
}


// UCITAVAM HEADER I NAVIGACIJU
Header::addHeader('Comments','');
$navigation->addNavigation($brojKategorija,$polje,@$_SESSION['username'],$_SESSION['status_korisnika'],$sessionWhiteList);


// UCITAVAM MAIN
Main::openMain();
    $md5 = $_GET['n'];
    $statusKorisnika = $_SESSION['status_korisnika'];
    @$username = htmlspecialchars_decode($_SESSION['username'],ENT_QUOTES); // mora jer smo dosada koristili enkodovanu promenljivu, sad posto komuniciramo sa bazom, moramo da je decodujemo
    $comments->printComments($md5,$polje,$statusKorisnika,$username,$sessionWhiteList);
Main::closeMain();


// SIDEBAR, NAVIGATION
if( $_SESSION['status_korisnika'] != $sessionWhiteList[2] ){
    require('sidebar.php');
    require('footer.php');
}