<?php

include_once 'dbConnect.php';
require_once 'getInfo.php';
require_once 'verifyNewUser.php';

$db = dbConnect::connect();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class updateTweet
{
    public $db;
    public $filename;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
        $this->filename = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];
    }

    public function refresh()
    {
        $currentDest = isset($_GET['refreshTweet'])
            ? $_GET['refreshTweet']
            : explode("/", $_SERVER["PHP_SELF"])[2];
        switch ($currentDest) {
            case 'index.php':
                ?><script src="Public/Jquery/replyTweet.js"></script>
                <script src="Public/Jquery/retweet.js"></script>
                <?php
                $this->seeFollow();
                $this->refreshAllTweet();
                break;
            case 'Profil':
                ?><script src="../Public/Jquery/replyTweet.js"></script>
                <script src="../Public/Jquery/retweet.js"></script>
                <?php
                $this->viewReplyUser();
                $this->refreshUserTweet();
                break;
            case 'Hashtag':
                $this->refreshHashTweet();
                break;
        }
    }

    public function viewReplyUser() {

        $nGetInfo = new GetInfo($this->db);
        $user = VerifyNewUser::verifyInput($_GET['f']);

        $idUser = $nGetInfo->getIdUser($user);
        $idUser = $idUser[0]['id_user'];

        $query = $this->db->query("SELECT t.id_tweet, t.tweet, u.name, u.photo, u.pseudo FROM re_tweet re
			INNER JOIN tweet t ON t.id_tweet = re.fk_id_tweet
            INNER JOIN users u
            ON t.fk_id_user = u.id_user
            WHERE re.fk_id_user = $idUser ORDER BY t.id_tweet DESC;");

        $this->refreshAction($query);
    }

    public function getReplyUser() {

        $arrReplyUser = [];
        $nGetInfo = new GetInfo($this->db);
        $idUser = $nGetInfo->getIdUser($_SESSION["login"]);
        $idUser = $idUser[0]['id_user'];

        $query2 = "SELECT re.fk_id_tweet FROM reponse_tweet re
            INNER JOIN users u
            ON re.fk_id_user = u.id_user
            WHERE re.fk_id_user = :fk_id_user ;";

        $pdo_select = $this->db->prepare($query2);
        $pdo_select->bindValue(":fk_id_user", $idUser);
        $pdo_select->execute();
        $replyUser = $pdo_select->fetchAll();

        foreach($replyUser as $key => $row) {
            array_push($arrReplyUser, $row["fk_id_tweet"]);
        }
        return $arrReplyUser;
    }

    public function getRetweetUser() {
        $arrRetweetUser = [];
        $nGetInfo = new GetInfo($this->db);
        $idUser = $nGetInfo->getIdUser($_SESSION["login"]);
        $idUser = $idUser[0]['id_user'];

        $query2 = "SELECT re.fk_id_tweet FROM re_tweet re
            INNER JOIN users u
            ON re.fk_id_user = u.id_user
            WHERE re.fk_id_user = :fk_id_user;";

        $pdo_select = $this->db->prepare($query2);
        $pdo_select->bindValue(":fk_id_user", $idUser);
        $pdo_select->execute();
        $retweetUser = $pdo_select->fetchAll();

        foreach($retweetUser as $key => $row) {
            array_push($arrRetweetUser, $row["fk_id_tweet"]);
        }
        return $arrRetweetUser;
    }

    public function seeFollow()
    {
        $nGetInfo = new GetInfo($this->db);
        $user = VerifyNewUser::verifyInput($_SESSION["login"]);

        $idUser = $nGetInfo->getIdUser($user);
        $idUser = $idUser[0]['id_user'];

        $query = $this->db->query("SELECT t.id_tweet, t.tweet, u.name, u.photo, u.pseudo FROM follow f
			INNER JOIN tweet t ON t.fk_id_user = f.fk_id_followed
            INNER JOIN users u
            ON t.fk_id_user = u.id_user
            WHERE f.fk_id_follower = $idUser ORDER BY t.id_tweet DESC;");

        $this->refreshAction($query);
    }

    public function refreshAllTweet()
    {
        $query = $this->db->query("SELECT * FROM tweet INNER JOIN users ON tweet.fk_id_user = users.id_user ORDER BY id_tweet DESC LIMIT 50");
        $this->refreshAction($query);
    }

    public function refreshUserTweet()
    {
        include_once 'getInfo.php';
        $obj = new getInfo($this->db);
        $pseudo = $obj->currentInfo()[0]["pseudo"];
        $query = $this->db->query("SELECT * FROM tweet INNER JOIN users ON tweet.fk_id_user = users.id_user WHERE users.pseudo = '$pseudo' ORDER BY id_tweet DESC");
        $this->refreshAction($query);
    }

    public function refreshHashTweet()
    {
        $query = $this->db->query("SELECT DISTINCT tweet, id_tweet, name, pseudo, photo FROM tweet 
            INNER JOIN users ON tweet.fk_id_user = users.id_user
            INNER JOIN hashtag ON hashtag.fk_id_tweet = tweet.id_tweet ORDER BY id_tweet DESC LIMIT 50");
        $this->refreshAction($query);
    }

    public function refreshAction($query)
    {
        $arrReplyUser = $this->getReplyUser();
        $arrRetweetUser = $this->getRetweetUser();
        $classReply = "";
        $classRetweet = "";
        $null = "";

        while ($data = $query->fetch()) {
            foreach($arrRetweetUser as $key => $value) {
                $data["id_tweet"] === $value? $classRetweet = "onRetweet" : $null = "off" ;
            }
            foreach($arrReplyUser as $key => $value) {
                $data["id_tweet"] === $value? $classReply = "onReply" : $null = "off" ;
            }

            $nbrReply = 0;
            $nbrRetweet = 0;
            $query2 = $this->db->prepare("SELECT 
            (SELECT COUNT(rt.fk_id_tweet) FROM reponse_tweet rt WHERE rt.fk_id_tweet = ?) AS 'nbrReply',
            (SELECT COUNT(fk_id_tweet) FROM re_tweet t WHERE t.fk_id_tweet = ?) AS 'nbrRetweet' ");
            $query2->execute(array($data["id_tweet"], $data["id_tweet"]));
            while($result = $query2->fetch()) {
                $nbrReply = $result["nbrReply"];
                $nbrRetweet = $result["nbrRetweet"];
            }
            ?>
            <div class="new__tweet item__border row">
                <input type="hidden" class="id_tweet" value="<?= $data["id_tweet"] ?>">
                <a href="<?= $this->filename ?>/Profil?f=<?= $data['pseudo'] ?>">
                    <img class="rounded-circle user_image--apercu"
                         src="<?= $this->filename ?>/Public/assets/images/default_profile_400x400.png"
                         alt="photo profil user">
                </a>

                <div style="margin-left: 10px;">
                    <div class="d-flex">
                        <a href="<?= $this->filename ?>/Profil?f=<?= $data['pseudo'] ?>" class="user__name"><?= $data['name'] ?></a>
                        <p class="user__pseudo ml-1">@<?= $data['pseudo'] ?></p>
                    </div>
                    <p class="tweet_message"><?= $data['tweet'] ?></p>
                    <div id="contentIcon">
                        <button id="reply" class="btn__reply btn__reply--sm reply <?= $classReply ?>" data-target="<?= $data["id_tweet"] ?>"><i class="far fa-comment"></i></button>
                        <?php if($nbrReply >= 1) { ?>
                            <span id="nbrReply"><?= $nbrReply ?></span>
                        <?php } ?>
                        <button id="retweet" class="btn__retweet btn__retweet--sm retweet <?= $classRetweet ?>" data-target="<?= $data["id_tweet"] ?>"><i class="fas fa-retweet"></i></button>
                        <?php if($nbrRetweet >= 1) { ?>
                            <span id="nbrRetweet"><?= $nbrRetweet ?></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php $classRetweet= "";
            $classReply= "";
        }
    }
}

$obj = new updateTweet();
$obj->refresh();

?>





