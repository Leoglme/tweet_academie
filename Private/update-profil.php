<?php
session_start();
require_once 'dbConnect.php';
require_once 'verifyNewUser.php';
require_once 'getInfo.php';
require_once 'hashedPass.php';

class updateProfil
{
    private $postData = [];
    private $vNewUser;
    private $db;

    function __construct($userTab, $db)
    {
        $this->db = $db;
        $this->vNewUser = new VerifyNewUser($userTab);
        $this->postData = ["login" => $this->vNewUser->getResultCheck()[2]["login"], "password" => $this->vNewUser->getResultCheck()[2]["password"],
            "name" => $this->vNewUser->getResultCheck()[2]["name"], "email" => $this->vNewUser->getResultCheck()[2]["email"],
            "birthDate" => $this->vNewUser->getResultCheck()[2]["birthDate"], "description" => $this->vNewUser->getResultCheck()[2]["description"]];
    }

    private function getPostData()
    {
        return $this->postData;
    }

    private function updateUser($name, $login, $password, $description, $photo, $birthDate, $theme, $email)
    {
        $nHashPass = new HashedPass($password);
        $password = $nHashPass->hashedPassRip160();

        $dateNow = new DateTime('NOW');
        $dateNow = $dateNow->format('Y-m-d');

        $query = "UPDATE users SET `name`= :u_name,`pass` = :u_password,`description`= :u_description, date_naissance = :birthDate, mail = :email
           WHERE pseudo = :u_login;";

        try {
            $pdo_insert = $this->db->prepare($query);
            $pdo_insert->bindValue(':u_name', $name, PDO::PARAM_STR);
            $pdo_insert->bindValue(':u_login', $login, PDO::PARAM_STR);
            $pdo_insert->bindValue(':u_password', $password, PDO::PARAM_STR);
            $pdo_insert->bindValue(':u_description', $description, PDO::PARAM_STR);
//            $pdo_insert->bindValue(':photo', $photo, PDO::PARAM_STR);
            $pdo_insert->bindValue(':birthDate', $birthDate, PDO::PARAM_STR);
//            $pdo_insert->bindValue(':theme', $theme, PDO::PARAM_INT);
            $pdo_insert->bindValue(':email', $email, PDO::PARAM_STR);
            $pdo_insert->execute();

        } catch (PDOException $e) {
            echo 'Erreur SQL : ' . $e->getMessage() . '<br/>';
            die();
        }
    }

    function run()
    {

        $photo = "/img";
        $theme = 1;

        // verify in Database
        $vIfExist = new GetInfo($this->db);
        $getSessionEmail = $vIfExist->sessionMail();
        $mailDb = $vIfExist->seekEmail($this->postData["email"]);

        if ($this->postData["email"] === $getSessionEmail) {

            $this->updateOrNot($photo, $theme);

        } else if (!$mailDb && $this->postData["email"] !== $getSessionEmail) {

            $this->updateOrNot($photo, $theme);

        }else{
            $data["mailExist"] = true;
            $data['success'] = false;
            echo json_encode($data);
        }
    }

    public function updateOrNot($photo, $theme)
    {
        if ($this->vNewUser->getAllSuccess()["isName"] && $this->vNewUser->getAllSuccess()["isLogin"] &&
            $this->vNewUser->getAllSuccess()["isPassword"] && $this->vNewUser->getAllSuccess()["isEmail"] &&
            $this->vNewUser->getAllSuccess()["isBirthDate"] && $this->vNewUser->getAllSuccess()["isDescription"]) {

            $this->updateUser($this->getPostData()["name"], $this->getPostData()["login"], $this->getPostData()["password"], $this->getPostData()["description"],
                $photo, $this->getPostData()["birthDate"], $theme, $this->getPostData()["email"]);
            $_SESSION["name"] = $this->getPostData()["name"];

            $data["name"] = $this->getPostData()["name"];
            $data["password"] = $this->getPostData()["password"];
            $data["description"] = $this->getPostData()["description"];
            $data["birthDate"] = $this->getPostData()["birthDate"];
            $data["email"] = $this->getPostData()["email"];
            $data["success"] = true;
            echo json_encode($data);

        } else { // prepare data tab tab for error message in folder js (form_register.js)
            $data["success"] = false;
            $data["isName"] = $this->vNewUser->getAllSuccess()["isName"];
            $data["isLogin"] = $this->vNewUser->getAllSuccess()["isLogin"];
            $data["isPassword"] = $this->vNewUser->getAllSuccess()["isPassword"];
            $data["isEmail"] = $this->vNewUser->getAllSuccess()["isEmail"];
            $data["isBirthDate"] = $this->vNewUser->getAllSuccess()["isBirthDate"];
            $data["isDescription"] = $this->vNewUser->getAllSuccess()["isDescription"];
            $data["mailExist"] = $this->vNewUser->getAllSuccess()["mailExist"];
            $data["loginExist"] = $this->vNewUser->getAllSuccess()["loginExist"];
            echo json_encode($data);
        }
    }
}

// when register submit (js/form_register.js) send here we begin the operation!
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $arrUpdate = $_POST['arrayUpdate'];
    $arrUpdate['login'] = $_SESSION['login'];
    $nRQ = new updateProfil($arrUpdate, dbConnect::connect());
    $nRQ->run();
    dbConnect::disconnect();
}