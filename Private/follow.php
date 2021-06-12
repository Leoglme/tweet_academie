<?php
require_once "dbConnect.php";
require_once "getInfo.php";
require_once "verifyNewUser.php";
session_start();

class Follow
{
    private $dB;
    private $followed;
    private $follower;
    private $isExist;
    private $idFollower = null;
    private $idFollowed = null;

    public function __construct($dB = null)
    {
        $this->dB = $dB;

        if(isset($_SESSION["login"]) && isset($_POST["followed"]) && isset ($_POST["clicked"]) && $_POST["clicked"] === "true" ) {
            $this->setDataCheckDb();
            $this->isExist === "0" ? $this->addFollowed() : $this->deleteFollowed();

        } else if (isset($_SESSION["login"]) && isset($_POST["followed"])) {
            $this->setDataCheckDb();

            $this->isExist === "0" ? $data["follow"] = false : $data["follow"] = true;
            $data["success"] = true;
            echo json_encode($data);
        }
    }

    private function setDataCheckDb() {
        $this->follower = $_SESSION["login"];
        $this->followed = VerifyNewUser::verifyInput($_POST["followed"]);
        $nGetInfo = new GetInfo($this->dB);
        $this->getFollower($nGetInfo);
        $this->getFollowed($nGetInfo);
        $this->checkFollow();
    }

    private function getFollower($nGetInfo) {
        $this->idFollower = $nGetInfo->getIdUser($this->follower);
    }

    private function getFollowed($nGetInfo) {
        $this->idFollowed = $nGetInfo->getIdUser($this->followed);
    }

    public function checkFollow() {
        $query = "SELECT COUNT(f.fk_id_followed) AS 'isExist' FROM follow f WHERE f.fk_id_follower = :fk_id_follower AND f.fk_id_followed = :fk_id_followed;";
        $pdo_select = $this->dB->prepare($query);
        $pdo_select->bindValue(":fk_id_follower", intval($this->idFollower[0]["id_user"]), PDO::PARAM_INT);
        $pdo_select->bindValue(":fk_id_followed", intval($this->idFollowed[0]["id_user"]), PDO::PARAM_INT);
        $pdo_select->execute();
        $result = $pdo_select->fetch();

        foreach($result as $key) {
            $this->isExist = $key;
        }
    }

    private function addFollowed() {

        $query = "INSERT INTO follow(fk_id_follower, fk_id_followed) VALUES (:fk_id_follower, :fk_id_followed);";
        $pdo_insert = $this->dB->prepare($query);
        $pdo_insert->bindValue(":fk_id_follower", intval($this->idFollower[0]["id_user"]), PDO::PARAM_INT);
        $pdo_insert->bindValue(":fk_id_followed", intval($this->idFollowed[0]["id_user"]), PDO::PARAM_INT);
        $pdo_insert->execute();

        $data["success"] = true;
        $data["follow"] = true;
        echo json_encode($data);
    }

    private function deleteFollowed() {
        $query = "DELETE FROM follow WHERE fk_id_follower = :fk_id_follower AND fk_id_followed = :fk_id_followed;";
        $pdo_insert = $this->dB->prepare($query);
        $pdo_insert->bindValue(":fk_id_follower", intval($this->idFollower[0]["id_user"]), PDO::PARAM_INT);
        $pdo_insert->bindValue(":fk_id_followed", intval($this->idFollowed[0]["id_user"]), PDO::PARAM_INT);
        $pdo_insert->execute();

        $data["success"] = true;
        $data["follow"] = false;
        echo json_encode($data);
    }
}

$newFollow = new Follow(dbConnect::connect());