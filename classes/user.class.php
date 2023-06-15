<?php
class user {
    public $dbObj = null;
    public $con = null;
    public $result = null;

    public function __construct(){
        $this->dbObj = new db;
        $this->con = $this->dbObj->dbcon;
    }


    public function userLogin($username, $password){
        $sql = "SELECT * FROM users WHERE username = BINARY('" . $username . "') AND userpass = password('" . $password . "');";
    	$this->result = $this->dbObj->selectFunction($sql);
        if($this->result[0] !== true){
            $_SESSION['userStatus'] = 0; 
        } else {
            $_SESSION['userStatus'] = 1;
        }
        $_SESSION['userId'] = $this->result[1][0][0];
        return $this->dbObj;
    }
    public function isUserLoggedIn(){
        session_start();
        if(!isset($_SESSION['userStatus'])){
            $_SESSION['userStatus'] = 0;
        } else {
            if($_SESSION['userStatus'] == 1){
                return 1;
            } else {
                $_SESSION['userStatus'] = 0;
                return false;
            }
        }
    }

    public function registerUser($userNameFromPOST, $userPassFromPOST, $firstFromPOST, $lastFromPOST, $dateOfBirthFromPOST){
        $sql = "INSERT INTO users(username, userpass, firstname, lastname, birthday) VALUES('" . $userNameFromPOST . "', password('" . $userPassFromPOST . "'), '" . $firstFromPOST . "', '" . $lastFromPOST . "', '" . $dateOfBirthFromPOST . "');";
        return $this->dbObj->otherSqlFunction($sql);
    }

    public function logoutUser(){
        if(isset($_SESSION)){
            $_SESSION['userStatus'] = 0;
            $_SESSION['userId'] = null;
            session_unset();
        }
    }
}
?>  
   