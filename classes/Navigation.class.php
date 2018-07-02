<?php

class Navigation{

    private $zaStampanje1;
    private $zaStampanje2;
    private $zaStampanje3;
    private $zaStampanje4 = "<li><a href=''></span>Welcome, Admin!</a></li>";
    private $zaStampanje5;
    private $zaStampanje6 = "<li><a href='news_add.php'></span>Add news</a></li>";



    public function addNavigation($brojKategorija,$polje,$sesijaUsername,$statusKorisnika,$sessionWhiteList){
        echo $this->nav1();
        echo $this->addNavLeft($brojKategorija,$polje,$sesijaUsername);
        echo $this->nav2();
        echo $this->addNavRight($statusKorisnika,$sessionWhiteList);
        echo $this->nav3();

    }









    private function addNavRight($statusKorisnika,$sessionWhiteList){
        if($statusKorisnika==$sessionWhiteList[0]){
            echo $this->zaStampanje1;
            echo $this->zaStampanje2;
        }else{
            if($statusKorisnika==$sessionWhiteList[1]){
                echo $this->zaStampanje5;
                echo $this->zaStampanje3;
            }else{
                echo $this->zaStampanje4;
                echo $this->zaStampanje6;
                echo $this->zaStampanje3;
            }
        }
    }



    private function addNavLeft($brojKategorija,$polje,$sesija_username){
        for($i=1;$i<=$brojKategorija;$i++){
            $tip = $polje->returnValueByColumn('categories','tip','category_id',$i);
            $menuName = $polje->returnValueByColumn('categories','menu_name','category_id',$i);
            if( $tip == 1 ){
                continue;
            }else{
                if( $tip == 2 ){
                    $this->zaStampanje1 = "<li><a href=\"signup.php\"><span class=\"glyphicon glyphicon-user active\"></span> {$menuName}</a></li>";
                    continue;
                }else{
                    if( $tip == 3 ){
                        $this->zaStampanje2 = "<li><a href=\"login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> {$menuName}</a></li>";
                        continue;
                    }else{
                        if( $tip == 4 ){
                            $this->zaStampanje3 = "<li><a href=\"logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> {$menuName}</a></li>";
                            continue;
                        }else{
                            if( $tip == 6 ){
                                continue;
                            }
                        }
                    }
                }
            }
            echo "<li>";
            echo "<a href=\"index.php?p={$i}\">";
            echo $menuName;
            echo "</a>";
            echo "</li>";
        }
        $this->zaStampanje5 = "<li><a href=''>Welcome, $sesija_username!</a></li>";
    }



    private function nav1(){
        $nav1 = "
            <body>

            <nav class=\"navbar navbar-default\">
                <div class=\"container-fluid\">
                    <div class=\"navbar-header\">
                        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <a class=\"navbar-brand active\" href=\"index.php\"><img class=\"img-rounded\" src=\"images/sportisimo-logo.jpg\" alt=\"sportisimo-logo\"></a>
                    </div>
                    <div class=\"collapse navbar-collapse\" id=\"myNavbar\">
                        <ul class=\"nav navbar-nav\">";

        return $nav1;
    }



    private function nav2(){
        $nav2 = "
                        </ul>
                        <ul class=\"nav navbar-nav navbar-right boxed\">";

        return $nav2;
    }



    private function nav3(){
        $nav3 = "
                        </ul>
                    </div>
                </div>
            </nav>";

        return $nav3;
    }

}