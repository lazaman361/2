<?php

require ('config.php');
session_start();
session_write_close();
$comments = new CommentsManipulation();
$polje = new DatabaseFetch();


// KOMENTAR NE MOZE DA UKLANJA NIKO KO NIJE ULOGOVAN
if( isset($_SESSION['status_korisnika']) && $_SESSION['status_korisnika'] == $sessionWhiteList[0] ){
    die("Oops, something's gone wrong.");
}


//AKO JE ULOGOVAN ADMIN, JEDNOSTAVNO BEZ PROVERE UBACI KOMENTAR
if( isset($_SESSION['status_korisnika']) && $_SESSION['status_korisnika'] == $sessionWhiteList[2] ){
    $commentId = $_GET['c'];
    $newsId = $_GET['n'];

    $comments->removeComment($commentId);
    Login::redirect('comments.php?n=' . md5($newsId));
}


// AKO JE ULOGOVAN KORISNIK, PROVERI SVE ZIVO DA NE BI MOGAO DA BRISE KOMENTARE KOJI NISU NJEGOVI
if( isset($_SESSION['status_korisnika']) && $_SESSION['status_korisnika'] == $sessionWhiteList[1] ){
    $commentId = $_GET['c'];
    $newsId = $_GET['n'];
    $userId = $_GET['u'];

    $commentIdExists = $comments->exists('comments','comment_id',$commentId,$polje);
    $newsIdExists = $comments->exists('comments','news_id',$newsId,$polje);
    $userIdExists = $comments->exists('comments','user_id',$userId,$polje);
    if( !($comments && $newsIdExists && $userIdExists) ){
        die("Oops, something's gone wrong.");
    }

    $usernameByUserId = ( htmlspecialchars($polje->returnValueByColumn('users','username','user_id',$userId),ENT_QUOTES) );
    if( !isset($_SESSION['username']) ){
        die("Oops, something's gone wrong.");
    }


    // DA LI JE user_id OSOBE KOJA BRISE ISTI KAO user_id KOJI SE BRISE. ONEMOGUCAVAM MALICIOZNOG KORISNIKA DA ULOGOVAN BRISE KOMENTARE KOJI NISU NJEGOVI
    if( $_SESSION['username'] != $usernameByUserId ){
        die("Oops, something's gone wrong.");
    }

    $comments->removeComment($commentId);
    Login::redirect( 'comments.php?n=' . md5($newsId) );
}
