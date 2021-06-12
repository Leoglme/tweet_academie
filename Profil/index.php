<?php
session_start();
include_once '../Private/getInfo.php';
include_once '../Private/dbConnect.php';
$db = dbConnect::connect();
$obj = new getInfo($db);

if (isset($obj->currentInfo()[0]["pseudo"]) && $_SESSION['login'] === $obj->currentInfo()[0]["pseudo"]) {
    include_once('profil_private.php');
}else{
    include_once('profil_public.php');
}