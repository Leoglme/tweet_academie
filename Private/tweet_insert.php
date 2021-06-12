<?php
session_start();
$filename = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];
$pseudo = $_SESSION['login'];
$tweet = htmlspecialchars($_POST['text']);
$dateNow = new DateTime('NOW');
$dateNow = $dateNow->format('Y-m-d');

/*Récupérer les hashtag du tweet*/
$getHashtag = preg_match_all('/(#(\w+))/', $tweet, $matches);
$getHashtag = $matches[2];

$bdd = new PDO('mysql:host=localhost;dbname=common-database', 'root', '');
$idUser = $bdd->query("SELECT id_user FROM users WHERE pseudo =" . "'$pseudo'");
$idUser = $idUser->fetch();
$idUser = $idUser["id_user"];



$bdd->query("ALTER TABLE tweet CHANGE tweet tweet VARCHAR(144) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL; ");
$insertText = $bdd->prepare("INSERT INTO tweet(fk_id_user, tweet, fk_id_hashtag, date_tweet) VALUES(?, ?, ?, ?)");
$insertText->execute(array($idUser, $tweet, 1, $dateNow));


$id_tweet = $bdd->query("SELECT id_tweet FROM tweet WHERE tweet =  '$tweet'");
$id_tweet = $id_tweet->fetch()['id_tweet'];
foreach ($getHashtag as $value) {
    $pushHashtag = $bdd->query("INSERT INTO hashtag(nom, fk_id_tweet) VALUES ('$value', '$id_tweet')");
}
?>

<div class="new__tweet item__border row">
    <a href="<?= $filename ?>/Profil">
        <img class="rounded-circle user_image--apercu"
             src="<?= $filename ?>/Public/assets/images/default_profile_400x400.png" alt="photo profil user">
    </a>

    <div style="margin-left: 10px;">
        <div class="d-flex">
            <a href="<?= $filename ?>/Profil" class="user__name"><?= $_SESSION['name'] ?></a>
            <p class="user__pseudo ml-1">@<?= $pseudo ?></p>
        </div>
        <p class="tweet_message"><?= html_entity_decode($tweet) ?></p>
    </div>
</div>

<?php
//?>






