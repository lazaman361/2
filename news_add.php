<?php

require ('config.php');
session_start();
session_write_close();

if( $_SESSION['status_korisnika'] != $sessionWhiteList[2] ){
    die("Oops, something's gone wrong.");
}

$login = new Login();
$polje = new DatabaseFetch();
$brojKategorija = $polje->returnTableNumberRows('categories',1,1);

// AKO JE SUBMITOVANO DODAVANJE VESTI:
if( isset($_POST['submit']) ){
    $authorId = $_POST['author_id'];
    $categoryId = $_POST['category_id'];
    $title = $_POST['title'];
    $thumbnail = $_POST['thumbnail'];
    $preview = $_POST['preview'];
    $content = $_POST['content'];
    NewsManipulation::addNews($authorId,$categoryId,$title,$thumbnail,$preview,$content);
}


// UCITAVANJE HEADERA
$tabName = $polje->returnValueByColumn('categories','tab_name','category_id',9);
Header::addHeader($tabName,'addNews');


// NAVIGACIJA
$navigation = new Navigation();
$navigation->addNavigation($brojKategorija,$polje,$sessionWhiteList[2],$sessionWhiteList[2],$sessionWhiteList);


// FORMA
$login->openFormTag('post','#');
    $login->postaviSadrzajForme('Author id:','text','author_id','','required','required','4');
    $login->postaviSadrzajForme('Category id:','text','category_id','','required','required','4');
    $login->postaviSadrzajForme('Title:','text','title','','required','required','100');
    echo "<p><b>Thumbnail:<b></p><input class='form-control' autocomplete='off' size='20' type='text' name=thumbnail maxlength=200 value='thumbnail-latest-news.jpg'>";
    $login->postaviSadrzajForme('Content preview:','text','preview','','required','required','1000');
    echo "<br><textarea name=\"content\" form=\"form_id\" rows='10' cols='19'></textarea>";
    $login->postaviSadrzajForme('&nbsp','submit','submit','Upload news','','','');
$login->closeFormTag();
