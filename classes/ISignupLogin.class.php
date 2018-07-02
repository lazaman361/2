<?php

abstract class ISignupLogin{

    public $alertDatabaseConnectionError = "<div class='redNotification centerTitle'>Something went wrong during database communication, please try again.</div>";


    public function openFormTag($method,$action){
        echo "<form id='form_id' class='form-group center-div' method=\"$method\" action=\"$action\">";
    }



    public function postaviSadrzajForme($titleName,$type,$name,$value,$placeholder,$required,$maxLength){
        echo "<p><b>$titleName<b></p>";
        if($type=='submit'){
            echo "<input type=$type name=$name value=\"$value\">";
        }else{
            echo "<input class='form-control' autocomplete='off' size='20' type=$type name=$name placeholder=$placeholder $required maxlength=$maxLength value='";
            if(!empty($this->{$name})){
                echo $this->{$name};
            }
            echo "'>";
        }
    }



    public function closeFormTag(){
        echo "</form><br><br>";
    }



    public function setVariables($names){
        $dekodovano=json_decode($names);
        if($names!=null){
            foreach ($dekodovano as $key=>$value){
                $this->{$key}=htmlspecialchars(trim($value),ENT_QUOTES); // Dodat htmlspecialchar, da ne bi mogli npr. javascript i navodnici da prodju (jer ove promenljive koristim u phpu pre nego sto ih prosledim bazi. Pre nego sto ovakav input prosledim PDO::prepare-u, izvrsicu htmlspecialchars_decode da bih sve inpute cisto prosledio bazi (jer baza je bezbedna kroz prepared statement i ogranicena je na 45 karaktera, a htmlspecialchar povecava svaki spec karakter). Gde god na stranama da pozivam username, on se vec cuva encodovan (jer je user loginovan), pa ne moram ponovo da htmlencodujem. A sifra je hashovana pa ni nju ne moram.
            }
        }
    }



    public function getVariable($name){
        return $this->{$name};
    }

}