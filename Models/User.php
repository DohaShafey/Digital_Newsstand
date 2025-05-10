<?php

class User {
    protected $userId;
    private $userName;
    private $userEmail;
    private $userPassword;
    protected $userRole;
    protected $languageId;
    
    public function setUserName($userName){
        $this->$userName = $userName;
    }

    public function setUserEmail($userEmail){
        $this->$userEmail = $userEmail;
    }

    public function setUserPassword($userPassword){
        $this->$userPassword = $userPassword;
    }

    public function getUserEmail(){
        return $this->userEmail;
    }   

    public function getUserPassword(){
        return $this->userPassword;
    }

    public function getUserId(){
        return $this->userId;
    }   
}

?>