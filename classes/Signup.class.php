<?php

class Signup extends ISignupLogin {

    public $alertUserExists = "<div class='redNotification centerTitle'>User already exists, try different username.</div>";
    public $success = "<br><div class='centerTitle'>You're successfully registered. Please proceed to <a href=\"login.php\"><button type='button' class='btn'>Login</button></a> or <button type='button' class='btn'><a href='index.php'>Home page</a></button><div>";



    public function addUser($firstName,$lastName,$username,$password,$email){
        Connection::$connection->beginTransaction();

        $firstName = htmlspecialchars_decode($firstName,ENT_QUOTES);
        $lastName = htmlspecialchars_decode($lastName,ENT_QUOTES);
        $username = htmlspecialchars_decode($username,ENT_QUOTES);
        $password = password_hash($password,PASSWORD_BCRYPT);
        $email = htmlspecialchars_decode($email,ENT_QUOTES);

        try{
            $konekcija=Connection::$connection->prepare("INSERT INTO users (first_name,last_name,username,password,email) VALUES (?,?,?,?,?)");
            $konekcija->bindValue(1,$firstName);
            $konekcija->bindValue(2,$lastName);
            $konekcija->bindValue(3,$username);
            $konekcija->bindValue(4,$password);
            $konekcija->bindValue(5,$email);
            $konekcija->execute();
            Connection::$connection->commit();
            return true;
        }

        catch(PDOException $e){
            Connection::$connection->rollBack();
            return false;
        }
    }
}