<?php
require_once "getTweetOrReply.php";
require_once "getInfo.php";
require_once "verifyNewUser.php";
require_once "dbConnect.php";

$fk_id_tweet = VerifyNewUser::verifyInput($_GET["id"]);
$nGetTweetOrReply = new GetTweetOrReply(dbConnect::connect());
$nGetInfo = new GetInfo();

$arrTweet = $nGetTweetOrReply->getThisTweet($fk_id_tweet);
$replyTweet = $nGetTweetOrReply->getReplyForTweet($fk_id_tweet);

$data["success"] = true;
$data["name"] = $arrTweet[0]["name"];
$data["tweet"] = $arrTweet[0]["tweet"];
$data["pseudo"] = $arrTweet[0]["pseudo"];
$data["date"] = $arrTweet[0]["date_tweet"];
$data["photo"] = $arrTweet[0]["photo"];
$data["reply"] = $replyTweet;

echo json_encode($data);
