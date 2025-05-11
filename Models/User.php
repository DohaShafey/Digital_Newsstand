<?php

class User {
    private $userId;
    private $userName;
    private $userEmail;
    private $userPassword;
    private $userRole;
    private $languageId;

//setters functions
    public function setUserName($userName){
        $this->userName = $userName;
    }

    public function setUserEmail($userEmail){
        $this->userEmail = $userEmail;
    }

    public function setUserPassword($userPassword){
        $this->userPassword = $userPassword;
    }

    public function setUserRole($userRole){
        $this->userRole = $userRole;
    }

    public function setLanguageId($languageId){
        $this->languageId = $languageId;
    }

//getters functions
    public function getUserId(){
        return $this->userId;
    }   

    public function getUserName(){
        return $this->userName;
    }  

    public function getUserEmail(){
        return $this->userEmail;
    }   

    public function getUserPassword(){
        return $this->userPassword;
    }

    public function getUserRole(){
        return $this->userRole;
    } 

    public function getLanguageId(){
        return $this->languageId;
    } 
}

?>