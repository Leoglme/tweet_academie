<?php
require_once "dbConnect.php";
require_once "getInfo.php";
require_once "fetch.php";
require_once "verifyNewUser.php";
session_start();

class viewFollow
{
    private $db;
    private $login;

    public function __construct($login) {
        $this->db = dbConnect::connect();
        $this->login = verifyNewUser::verifyInput($login);
        $this->run();
    }

    private function run() {

        $nGetInfo = new GetInfo($this->db);
        $profil = $nGetInfo->getIdUser($this->login)[0]["id_user"];
        $currentUser = $nGetInfo->getIdUser($_SESSION["login"]);

        $name = $nGetInfo->getName($this->login);
        $arrFollower = $nGetInfo->getFollower($profil);
        $arrFollowed = $nGetInfo->getFollowed($profil);

        // compare to actual user for know if already follow by him
        $arrFollowedUser = $nGetInfo->getFollowed($currentUser);

        $data = ["name" => $name, "followed" => $arrFollowed, "follower" => $arrFollower,
            "arrFollowedUser" => $arrFollowedUser];

        $data["success"] = true;
        echo json_encode($data);
    }
}

$nViewFollow = new viewFollow($_GET["login"]);
