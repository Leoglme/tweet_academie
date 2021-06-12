<?php
require_once 'fetch.php';
require_once 'dbConnect.php';
require_once 'verifyNewUser.php';
require_once 'getTweetOrReply.php';

session_start();
$db = dbConnect::connect();
$fk_idTweet = VerifyNewUser::verifyInput($_POST["myData"]["fkIdTweet"]);

$nGetTweetReply = new GetTweetOrReply($db);
$viewTweet = $nGetTweetReply->selectTweetReply($fk_idTweet);

$tweet = $viewTweet[0]["tweet"];
dbConnect::disconnect();
$data["success"] = true;
$data["tweet"] = $tweet;

echo json_encode($data);
