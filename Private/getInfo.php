<?php

require_once "dbConnect.php";

class GetInfo
{
    private $dB;
    public $fetchClass;
    private $salt = "vive le projet tweet_academy";

    public function __construct($dB = NULL)
    {
        if (!is_null($dB)) {
            $this->dB = $dB;
        }
        require_once "fetch.php";
        $this->fetchClass = new fetch($this->dB);
    }

    public function seekLogin($login)
    {
        $queryVerify = "SELECT COUNT(id_user) AS isExist, pseudo FROM users WHERE pseudo = :username;";
        $pdo_select = $this->dB->prepare($queryVerify);

        $pdo_select->bindValue(':username', $login, PDO::PARAM_STR);
        return $this->selectDataExist($pdo_select);
    }

    public function getFollower($fk_id_Followed) {
        $nFetch = new fetch($this->dB);
        $arrFollower = [];

        $query = "SELECT f.fk_id_follower, u.name, u.pseudo, u.photo, u.description, u.id_user 
                FROM follow f INNER JOIN users u ON u.id_user = f.fk_id_follower WHERE f.fk_id_followed = :fk_id_followed;";
        $pdo_select = $this->dB->prepare($query);
        $pdo_select->bindValue(':fk_id_followed', intval($fk_id_Followed), PDO::PARAM_INT);
        $pdo_select->execute();
        $result = $pdo_select->fetchALL();
        $pdo_select->closeCursor();
        $nFetch->queryBindVal($arrFollower, $result);

       return $arrFollower;
    }

    public function getFollowed($profil) {
        $nFetch = new fetch($this->dB);
        $arrFollowed = [];

        $query = "SELECT f.fk_id_followed, u.name, u.pseudo, u.photo, u.description, u.id_user 
                FROM follow f INNER JOIN users u ON u.id_user = f.fk_id_followed WHERE f.fk_id_follower = :profil;";
        $pdo_select = $this->dB->prepare($query);
        $pdo_select->bindValue(':profil', intval($profil), PDO::PARAM_INT);
        $pdo_select->execute();
        $result = $pdo_select->fetchALL();
        $pdo_select->closeCursor();
        $nFetch->queryBindVal($arrFollowed, $result);

        return $arrFollowed;
    }

    public function getNbrFollower($fk_id_Followed) {
        $nFetch = new fetch($this->dB);
        $arrNbrFollower = [];

        $query = "SELECT COUNT(fk_id_follower) AS nbrFollower FROM follow WHERE fk_id_followed = :fk_id_followed;";
        $pdo_select = $this->dB->prepare($query);
        $pdo_select->bindValue(':fk_id_followed', intval($fk_id_Followed), PDO::PARAM_INT);
        $pdo_select->execute();
        $result = $pdo_select->fetchALL();
        $nFetch->queryBindVal($arrNbrFollower, $result, "nbrFollower");

        return $arrNbrFollower[0];
    }

    public function getNbrFollowed($fk_id_Follower) {
        $nFetch = new fetch($this->dB);
        $arrNbrFollowed = [];

        $queryVerify = "SELECT COUNT(fk_id_follower) AS nbrFollowed FROM follow WHERE fk_id_follower = :fk_id_follower;";
        $pdo_select = $this->dB->prepare($queryVerify);
        $pdo_select->bindValue(':fk_id_follower', $fk_id_Follower, PDO::PARAM_INT);
        $pdo_select->execute();
        $result = $pdo_select->fetchALL();

        $nFetch->queryBindVal($arrNbrFollowed, $result, "nbrFollowed");
        return $arrNbrFollowed[0];
    }

    public function seekEmail($email)
    {

        $queryVerify = "SELECT COUNT(id_user) AS isExist, mail FROM users WHERE mail = :email;";
        $pdo_select = $this->dB->prepare($queryVerify);
        $pdo_select->bindValue(':email', $email, PDO::PARAM_STR);
        return $this->selectDataExist($pdo_select);
    }

    public function sessionMail(){
        $email = '';
        $pseudo = $_SESSION['login'];
        $sql = "SELECT mail FROM users WHERE pseudo = :login;";
        $data = $this->dB->prepare($sql);
        $data->bindValue(':login', $pseudo, PDO::PARAM_STR);
        $data->execute();
        $result = $data->fetchAll();
        foreach ($result as $key => $value){
            $email = $value['mail'];
        }
        return $email;
    }

    function verifyPassword($password, $login)
    {
        $result = false;
        $queryVerify = "SELECT pass FROM users WHERE pseudo = :pseudo;";
        $pdo_select = $this->dB->prepare($queryVerify);

        $pdo_select->bindValue(':pseudo', $login, PDO::PARAM_STR);
        $pdo_select->execute();
        $nbrData = $pdo_select->rowCount();
        $rowAll = $pdo_select->fetchAll();
        $pdo_select->closeCursor();
        $pdo_select = null;

        if ($nbrData > 0) {
            foreach ($rowAll as $row) {
                if ($password === $row["pass"]) {
                    $result = true;
                }
            }
        } else {
            $result = false;
        }
        return $result;
    }

    function selectDataExist($pdo_select)
    {
        $pdo_select->execute();
        $nbrData = $pdo_select->rowCount();
        $rowAll = $pdo_select->fetchAll();
        $pdo_select->closeCursor();
        $pdo_select = null;

        if ($nbrData > 0) {
            foreach ($rowAll as $row) {
                $isExist = $row["isExist"];
            }
            if ($isExist == 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function getName($login)
    {
        $arrName = [];
        $nFetch = new fetch($this->dB);
        $SQL = "SELECT name FROM users WHERE pseudo = :username;";

        $pdo_select = $this->dB->prepare($SQL);
        $pdo_select->bindValue(':username', $login, PDO::PARAM_STR);
        $pdo_select->execute();
        $result = $pdo_select->fetchAll();
        $nFetch->queryBindVal($arrName, $result);
        return $arrName;
    }

    public function lastUserTweet()
    {
        $array = [];
        $SQL = 'SELECT DISTINCT name, pseudo FROM tweet
                INNER JOIN users ON tweet.fk_id_user = users.id_user
                ORDER BY id_tweet DESC LIMIT 0,3';
        $this->fetchClass->query($SQL, $array);
        return $array;
    }

    public function getDateRegister($pseudo){
        /*Pour passer le mois en FR*/
        $this->dB->query("SET lc_time_names = 'fr_FR'");
        $array = [];
        $SQL = "SELECT DATE_FORMAT(date_inscription, '%M %Y') AS 'registerDate' FROM users WHERE pseudo = '$pseudo'";
        $this->fetchClass->query($SQL, $array);
        return $array[0]["registerDate"];
    }

    public function getIdUser($login) {
        $arrLogin = [];
        $nFetch = new fetch($this->dB);
        $SQL = "SELECT id_user FROM users WHERE pseudo = :username;";

        $pdo_select = $this->dB->prepare($SQL);
        $pdo_select->bindValue(':username', $login, PDO::PARAM_STR);
        $pdo_select->execute();
        $result = $pdo_select->fetchAll();

        $nFetch->queryBindVal($arrLogin, $result);
        return $arrLogin;
    }

    public function countUserTweet($pseudo){
        $array = [];
        $userId = $this->getIdUser($pseudo)[0]["id_user"];
        $SQL = "SELECT COUNT(tweet) AS 'countTweet' FROM tweet WHERE fk_id_user = " . $userId;
        $this->fetchClass->query($SQL, $array);
        return $array[0]['countTweet'];
    }

    public function getBio($pseudo){
        $array = [];
        $SQL = "SELECT description AS 'bio' FROM users WHERE pseudo = '$pseudo'";
        $this->fetchClass->query($SQL, $array);
        return $array[0]['bio'];
    }

    public function getAllUserInfos($pseudo){
        $array = [];
        $SQL = "SELECT * FROM users WHERE pseudo = '$pseudo'";
        $this->fetchClass->query($SQL, $array);
        return $array[0];
    }

    public function currentInfo()
    {
        $array = [];
        if (isset($_GET['f']) && $_SESSION['login'] === $_GET['f']) {
            $usersId = $_SESSION['login'];
        }else if(!isset($_GET['f']) || empty($_GET['f'])) {
            $usersId = $_SESSION['login'];
        }else{
            $usersId = $_GET['f'];
        }
        $SQL = "SELECT * FROM users WHERE pseudo = '$usersId'";
        $this->fetchClass->query($SQL, $array);
        return $array;
    }
}