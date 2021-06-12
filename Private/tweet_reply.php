<?php
require_once 'verifyNewUser.php';
require_once 'getInfo.php';
require_once 'dbConnect.php';

session_start();
$db = dbConnect::connect();
$nGetInfo = new GetInfo($db);
$id_user = $nGetInfo->getIdUser($_SESSION["login"]);
$replyTweet = VerifyNewUser::verifyInput($_POST["myData"]["replyTweet"]);
$fk_idTweet = VerifyNewUser::verifyInput($_POST["myData"]["fkIdTweet"]);

function insertReply($fk_idTweet, $reply, $fk_idUser, $db)
{
    $dateNow = new DateTime('NOW');
    $dateNow = $dateNow->format('Y-m-d');

    $query = "INSERT INTO reponse_tweet (fk_id_tweet,message,date,fk_id_user)
            VALUES (:fk_id_tweet,:reply,:dateInscription,:fk_id_user);";

    try {
        $pdo_insert = $db->prepare($query);
        $pdo_insert->bindValue(':fk_id_tweet', $fk_idTweet, PDO::PARAM_STR);
        $pdo_insert->bindValue(':reply', $reply, PDO::PARAM_STR);
        $pdo_insert->bindValue(':dateInscription', $dateNow);
        $pdo_insert->bindValue(':fk_id_user', $fk_idUser, PDO::PARAM_STR);

        $pdo_insert->execute();

    } catch (PDOException $e) {
        echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die();
    }
}

insertReply($fk_idTweet, $replyTweet , $id_user[0]["id_user"], $db);
dbConnect::disconnect();
$data["success"] = true;
echo json_encode($data);
