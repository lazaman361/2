<?php

class Main{

    public static function openMain(){
        echo "
            <div id=wrapper class=\"container\">
                <div id=\"middle\" class=\"row\">
                    <div class=\"col-md-9\">
        ";
    }



    public static function closeMain(){
        echo "
            </div> <!-- end col-md-9-->
        ";
    }



    public static function addMainContent($polje,$strana,$statusKorisnika){

        $tabName = $polje->returnValueByColumn('categories','tab_name','category_id',$strana);
        $ikonica = $polje->returnValueByColumn('categories','icon_path','category_id',$strana);

        if( $strana == 1 ){
            echo "<h2 class='centerTitleMain'><img src='images/" . $ikonica . "'>" . " All news<br><br></h2>";
            $polje->printSelectedNews(1,1,'',$statusKorisnika);
        }else{
            echo "<h2 class='centerTitleMain'><img src='images/" . $ikonica . "'>" . "<span> $tabName<br><br></span></h2>";
            $polje->printSelectedNews('categories.category_id',$strana,'',$statusKorisnika);
        }

    }

}