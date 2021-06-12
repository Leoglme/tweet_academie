<?php
require_once 'dbConnect.php';
require_once 'verifyNewUser.php';
require_once 'getInfo.php';
require_once 'hashedPass.php';

class Log
{
    private $db;
    private $login;
    private $password;
    private $name;

    public function __construct($login, $password) {

        $login = VerifyNewUser::verifyInput($login);
        $password = VerifyNewUser::verifyInput($password);

        $this->db = dbConnect::connect();
        $this->login = $login;
        $this->password = $password;
        $this->checkLoginPass();
    }

    private function checkLoginPass() {

        $nVNewUser = new VerifyNewUser();
        $nVNewUser->isLogin($this->login);
        $nVNewUser->isPassword($this->password);

        $allSuccess = $nVNewUser->getAllSuccess();

        // Verify if login and password are good before check in database
        if($allSuccess["isLogin"] & $allSuccess["isPassword"]) {
            $nGetInfo = new getInfo($this->db);
            $nHPass = new HashedPass($this->password);

            // Verify if login exist in db
            $seekLogin = $nGetInfo->seekLogin($this->login);

            // if login exist transform password and compare in database
            if ($seekLogin === true) {
                $password = $nHPass->hashedPassRip160($this->password);
                $this->name = $nGetInfo->getName($this->login);
                $result = $nGetInfo->verifyPassword($password, $this->login);

                $this->validOrInvalidReturn($result);
            } else {
                $this->validOrInvalidReturn(false);
            }
        } else {
            $this->validOrInvalidReturn(false);
        }
    }

    function validOrInvalidReturn($result) {
        // if user data exist start session and redirect in form_login.js
        if ($result === true) {
            session_start();
            $_SESSION['login'] = $this->login;
            $_SESSION['name'] = $this->name[0]["name"];
            $data['success'] = true;
            echo json_encode($data);
        } else {
            $data['success'] = false;
            echo json_encode($data);
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nLog = new Log($_POST["myData"]['login'], $_POST["myData"]['password']);
    dbConnect::disconnect();
}