<?php

class VerifyNewUser {

    protected $isSucces;
    protected $allSuccess = [];
    protected $allData = [];
    protected $resultCheck = [];

    function __construct($arr_data = null) {

        $this->allSuccess = ["isName" => true, "isLogin" => true, "isPassword" => true, "isEmail" => true,
            "isBirthDate" => true, "isDescription" => true, "isPhoto" => true, "isTheme" => true, "mailExist" => false,
            "loginExist" =>false];

        $this->isSucces = true;
        if ($arr_data !== null) {
            $this->allData = $arr_data;
            $this->allCheck($this->allData);
        }
    }

    public function getAllData() {
        return $this->allData;
    }

    public function getAllSuccess() {
        return $this->allSuccess;
    }

    public function setSuccessMail($verifyMailDb) {
        $this->allSuccess["mailExist"] = $verifyMailDb;
    }

    public function setSuccessLogin($verifyLoginDb) {
        $this->allSuccess["loginExist"] = $verifyLoginDb;
    }

    public function getResultCheck() {
        return $this->resultCheck;
    }

    function allCheck($allData) {

        $this->allData["login"] = $this->verifyInput($allData["login"]);
        $this->allData["password"] = $this->verifyInput($allData["password"]);
        $this->allData["name"] = $this->verifyInput($allData["name"]);
        $this->allData["email"] = $this->verifyInput($allData["email"]);
        $this->allData["birthDate"] = $this->verifyInput($allData["birthDate"]);
        $this->allData["description"] = $this->verifyInput($allData["description"]);

        if (isset($allData["name"]) && strlen($allData["name"]) > 0) {
            $this->allData["name"] = $this->isName($allData["name"]);
        } else {
            $this->allSuccess["isName"] = false;
        }

        if (isset($allData["login"]) && strlen($allData["login"]) > 0) {
            $this->allData["login"] = $this->isLogin($allData["login"]);
        } else {
            $this->allSuccess["isLogin"] = false;
        }

        if (isset($allData["password"]) && strlen($allData["password"]) > 0) {
            $this->allData["password"] = $this->isPassword($allData["password"]);
        } else {
            $this->allSuccess["isPassword"] = false;
        }

        if (isset($allData["email"]) && strlen($allData["email"]) > 0) {

            $this->allData["email"] = $this->isEmail($allData["email"]);
            if($this->isEmail($allData["email"]) === false) {
                $this->allSuccess["isEmail"] = false;
            }

        } else {
            $this->allSuccess["isEmail"] = false;
        }

        if (isset($allData["birthDate"]) && strlen($allData["birthDate"]) > 0) {
            $this->allData["birthDate"] = $this->isDate($allData["birthDate"]);
        } else {
            $this->allSuccess["isBirthDate"] = false;
        }

        if (isset($allData["description"]) && strlen($allData["description"]) > 0) {

            $this->allData["description"] = $this->isDescription($allData["description"]);
        } else {
            $this->allSuccess["isDescription"] = false;
        }

        if (!$this->allSuccess["isLogin"] || !$this->allSuccess["isPassword"] || !$this->allSuccess["isEmail"]) {
            $this->isSucces = false;
        }

        if (!$this->allSuccess["isDescription"] || !$this->allSuccess["isBirthDate"]) {
            $this->isSucces = false;
        }

        $this->resultCheck = [$this->isSucces , $this->allSuccess , $this->allData];
    }

    static function verifyInput($var) {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }

    function isDescription($var) {

        $descriptionValid = preg_match('#[a-zA-ZàáâäæçéèêëîïôœùûüÿÀÂÄÆÇÉÈÊËÎÏÔŒÙÛÜŸ0-9 \-\']{8,255}$#Ui', $var);

        if(!$descriptionValid){

            $this->allSuccess["isDescription"] = false;
        }
        return $var;
    }

    function isEmail($var) {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function isLogin($var) {
        $loginValid = preg_match('#^([a-zA-Z0-9-_]{6,30})$#Ui', $var);

        if (!$loginValid){
            $this->allSuccess["isLogin"] = false;
        }
        return $var;
    }

    function isPassword($var) {

        $passwordValid = preg_match('/\A(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9]{7,}\z/', $var);
        if (!$passwordValid) {
            $this->allSuccess["isPassword"] = false;
        }
        return $var;
    }

    function isName($var) {
        $nameValid = preg_match('#[a-zA-ZàáâäæçéèêëîïôœùûüÿÀÂÄÆÇÉÈÊËÎÏÔŒÙÛÜŸ \-\']{2,100}$#Ui', $var);

        if(!$nameValid){

            $this->allSuccess["isName"] = false;

            if(strlen($var) < 2 || strlen($var) > 100) {

                $this->allSuccess["isName"] = false;
            }
        }
        return $var;
    }

    function isDate($var) {

        $date = preg_match('/^(19|20)\d{2}-(0[1-9]|1[0-3])-(0[1-9]|1\d|2\d|3[01])$/', $var);
        if(!$date) {
            $this->allSuccess["isDate"] = false;
        }
        return $var;
    }
}
?>