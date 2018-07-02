<?php

class Login extends ISignupLogin{

    private $match;
    public $checkYourInput = '<div class="centerTitle redNotification">Please check your input and try again.</div>';



    public function matchUser($username,$password){

        $retrieved = $this->queryUsers($username);
        if(!$retrieved){
            die($this->alertDatabaseConnectionError);
        }

        $retrieved = $this->match->fetchObject('Login');
        if(!$retrieved){
            return false;
        }

        if( password_verify($password,$retrieved->password) ){
            return true;
        }else{
            return false;
        }

    }



    public static function redirect($url)
    {
        $string = '<script>';
        $string .= 'window.location = "' . $url . '"';
        $string .= '</script>';

        echo $string;
    }



    private function queryUsers($username){
        Connection::$connection->beginTransaction();
        $username = htmlspecialchars_decode($username,ENT_QUOTES);

        try{
            $this->match = Connection::$connection->prepare("SELECT password FROM users WHERE BINARY username = ?");
            $this->match->bindValue(1,$username);
            $this->match->execute();
            Connection::$connection->commit();
            return true;
        }

        catch(PDOException $e){
            Connection::$connection->rollBack();
            return false;
        }
    }
}