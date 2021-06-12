<?php
    require_once "dbConnect.php";
    require_once "getInfo.php";
    require_once "verifyNewUser.php";
    session_start();

class Retweet
{
    private $dB;

    function __construct()
    {
        $this->dB = dbConnect::connect();
        $this->insertRetweet();
    }

    private function checkIfExist($fkIdUser, $fkIdTweet) {

        $query = "SELECT COUNT(fk_id_tweet) AS 'isExist' FROM re_tweet WHERE fk_id_tweet = :fk_id_tweet AND fk_id_user = :fk_id_user;";
        $pdo_select = $this->dB->prepare($query);
        $pdo_select->bindValue(":fk_id_user", $fkIdUser, PDO::PARAM_INT);
        $pdo_select->bindValue(":fk_id_tweet", $fkIdTweet, PDO::PARAM_INT);
        $pdo_select->execute();
        $isExist = $pdo_select->fetch();

        foreach ($isExist as $key){
            $isExist = $key;
        }
//
        $isExist > 0 ? $result = true : $result = false;
        return $result;
    }

    private function insertRetweet() {

        $nGetInfo = new GetInfo($this->dB);
        $id_user = $nGetInfo->getIdUser($_SESSION["login"]);
        $fkIdTweet = VerifyNewUser::verifyInput($_POST["myData"]["fkIdTweet"]);
        $id_user = VerifyNewUser::verifyInput($id_user[0]["id_user"]);

        $isExist = $this->checkIfExist(intval($id_user), intval($fkIdTweet));

        if(!$isExist) {
            $query = "INSERT INTO re_tweet (fk_id_tweet, fk_id_user) VALUES (:fk_id_tweet, :fk_id_user);";
            $pdo_insert = $this->dB->prepare($query);
            $pdo_insert->bindValue(":fk_id_tweet", intval($fkIdTweet), PDO::PARAM_INT);
            $pdo_insert->bindValue(":fk_id_user", intval($id_user), PDO::PARAM_INT);
            $pdo_insert->execute();
            $data["success"] = true;
            echo json_encode($data);
        } else {
            $query = "DELETE FROM re_tweet WHERE fk_id_tweet = :fk_id_tweet AND fk_id_user = :fk_id_user ;";
            $pdo_delete = $this->dB->prepare($query);
            $pdo_delete->bindValue(":fk_id_tweet", intval($fkIdTweet), PDO::PARAM_INT);
            $pdo_delete->bindValue(":fk_id_user", intval($id_user), PDO::PARAM_INT);
            $pdo_delete->execute();
            $data["success"] = true;
            echo json_encode($data);
        }
    }
}

$retweet = new Retweet();

