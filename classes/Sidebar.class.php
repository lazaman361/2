<?php

class Sidebar{

    public $nizRandomBrojeva = [];
    public $nizRandomFakata = [];
    public $randomNumberGenerator;



    public function printFacts($numberOfFacts,$polje){

        $totalFacts = $polje->returnTableNumberRows('facts',1,1);

        for( $i=1; $i<=$numberOfFacts; $i++){
            do{
                $this->randomNumberGenerator = rand(1,$totalFacts);
            }while( in_array($this->randomNumberGenerator,$this->nizRandomBrojeva) );
            $this->nizRandomBrojeva[] = $this->randomNumberGenerator;
            $this->nizRandomFakata[] = $polje->returnValueByColumn('facts','fact','fact_id',$this->randomNumberGenerator);
        }

        for( $i=0; $i<$numberOfFacts; $i++){
            echo "<blockquote class=\"blockquote fixed-top\">";
                echo $this->nizRandomFakata[$i];
            echo "</blockquote>";
        }

    }

}