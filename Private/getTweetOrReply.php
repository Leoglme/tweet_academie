<?php

require_once "fetch.php";
require_once "dbConnect.php";

class GetTweetOrReply {

    private $dB;

    public function __construct($dB = NULL) {
        if (!is_null($dB)) {
            $this->dB = $dB;
        }
    }

    function selectTweetReply($fk_idTweet)
    {
        $arrTweet = [];
        $nFetch = new fetch($this->dB);
        $query = "SELECT tweet , fk_id_user FROM tweet WHERE id_tweet = :fk_id_tweet ;";

        try {
            $pdo_select = $this->dB->prepare($query);
            $pdo_select->bindValue(':fk_id_tweet', $fk_idTweet, PDO::PARAM_STR);
            $pdo_select->execute();
            $result = $pdo_select->fetchAll();

            $nFetch->queryBindVal($arrTweet, $result);
            return $arrTweet;

        } catch (PDOException $e) {
            echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die();
        }
    }

    public function getThisTweet($id_tweet) {
        $queryFirst = "SET lc_time_names = 'fr_FR'";
        $pdo_select = $this->dB->prepare($queryFirst);
        $pdo_select->execute();

        $nFetch = new Fetch($this->dB);
        $arrTweet = [];

        $query = "SELECT t.fk_id_user , t.tweet, DATE_FORMAT(date_tweet, '%d %M') AS 'date_tweet', u.name, u.pseudo, u.photo
            FROM tweet t INNER JOIN users u ON t.fk_id_user = u.id_user 
            WHERE t.id_tweet = :id_tweet
            ORDER BY id_tweet DESC LIMIT 30;";

        $pdo_select = $this->dB->prepare($query);
        $pdo_select->bindValue(':id_tweet', $id_tweet, PDO::PARAM_STR);
        $pdo_select->execute();
        $result = $pdo_select->fetchAll();

        $nFetch->queryBindVal($arrTweet, $result);
        return $arrTweet;
    }

    public function getReplyForTweet($fk_id_tweet)
    {
        $nFetch = new Fetch($this->dB);
        $arrReply = [];

        $query = "SELECT u.name, u.pseudo, rt.message, DATE_FORMAT(rt.date, '%d %M') AS 'date', rt.fk_id_user
        FROM users u
        INNER JOIN reponse_tweet rt ON id_user = fk_id_user
        WHERE rt.fk_id_tweet = :fk_id_tweet
        ORDER BY rt.date DESC;";

        $pdo_select = $this->dB->prepare($query);
        $pdo_select->bindValue(':fk_id_tweet', $fk_id_tweet, PDO::PARAM_STR);
        $pdo_select->execute();
        $result = $pdo_select->fetchAll();

        $nFetch->queryBindVal($arrReply, $result);
        return $arrReply;
    }
}