<!DOCTYPE html>
<?php
include_once '../Public/Elements/sessionIsActiver.php';
include_once '../Private/getInfo.php';
include_once '../Private/dbConnect.php';
$dB = dbConnect::connect();
$obj = new GetInfo($dB);
$registerDate = $obj->getDateRegister($_GET['f']);
$countTweet = $obj->countUserTweet($_GET['f']);
$result  = $obj->getAllUserInfos($_GET['f']);

$profil = $obj->getIdUser($_GET['f']);
$nbrFollower = $obj->getNbrFollower($profil[0]["id_user"]);
$nbrFollow = $obj->getNbrFollowed($profil[0]["id_user"]);

$bio = $obj->getBio($_GET['f']);
$filename = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];
?>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?= $result['name'] . " (@" . $_GET['f'] . ")"?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/054fdad312.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../Public/Jquery/scrollingMenu.js"></script>
    <script src="../Public/Jquery/addTweet.js"></script>
    <script src="../Public/Jquery/replyTweet.js"></script>
    <script src="../Public/Jquery/update-tweet.js"></script>
    <script src="../Public/Jquery/emojis.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/CSS/style.css">
    <link rel="icon" href="../Public/assets/images/logo-onglet.png">
</head>
<body>
<?php include_once "../Public/Elements/navbar.php"; ?>
<div class="modal bg-poppins" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content tweet__modal">
            <div class="modal-header tweet__modal--header">
                <i class="fas fa-times tweet__modal--close"></i>
            </div>
            <div class="modal-body">
                <div class="form-group d-flex">
                    <img class="rounded-circle user_image--apercu"
                         src="../Public/assets/images/default_profile_400x400.png" alt="photo profil user"  style="height: max-content;">
                    <label for="newTweet"></label>
                    <textarea class="form-control hide__input" id="newTweet" rows="3"
                              placeholder="Que veux tu partager ?" maxlength="144"></textarea>
                </div>

                <hr class="divider__sm--sm">
                <div class="left__col--btn footer__modal--sm" style="padding: 8px 0;">
                    <div class="utils">
                        <i class="far fa-smile smile2"></i>
                    </div>
                    <button id="send" class="btn btn-info sm__btn--disabled mr-3 add__tweet--btn" disabled>Tweet</button>
                </div>
            </div>
            <hr>
            <div class="left__col--btn footer__modal" style="padding: 8px 0;">
                <div class="utils">
                    <i class="far fa-smile smile2"></i>
                </div>
                <button id="send" class="btn btn-info sm__btn--disabled mr-3 add__tweet--btn" disabled>Tweet</button>
            </div>
        </div>
    </div>
</div>

<!--<button id="send">Tweet</button>-->
<div class="container-fluid" style="min-height: 100vh;">
    <div class="row">
        <?php include_once '../Public/Elements/leftCol.php'?>
        <div class="col tweet__feed" id="profilePage">
            <div class="row item__border p-0">
                <div class="left__col--item">
                    <a href="../" class="fas fa-arrow-left"></a>
                </div>
                <div class="profil__tweet--header">
                    <h1 class="user__name--bold"><?= $result['name'] ?></h1>
                    <p class="user__pseudo"><?= $countTweet ?> tweet</p>
                </div>

                <div class="user__banner">
                    <div class="user__banner--info">
                        <div class="user_image--lg" style="background: url('<?= $filename ?>/Public/assets/images/default_profile_400x400.png');"></div>
                        <button id="follow" class="btn btn-outline-info <?= $isFollow ?>" type="button"></button>
                        <input type="hidden" id="followed" value="<?= $_GET['f'] ?>">
                    </div>
                </div>

                <div>
                    <div class="profil__tweet--header" style="line-height: 25px; padding-left: 5px;">
                        <h1 class="user__name--bold"><?= $result['name'] ?></h1>
                        <p class="user__pseudo">@<?= $_GET['f'] ?></p>
                        <p class="user__pseudo mt-2"><i class="far fa-calendar-alt"></i> A rejoint Twitter en <?= $registerDate ?></p>
                        <p class="user__pseudo tweet_message mt-2"><?= $bio ?></p>
                        <div>
                            <a class="user__pseudo mr-3" id="abonnements"><span class="user__pseudo bold"><?= $nbrFollow ?></span> abonnements</a>
                            <a class="user__pseudo" id="abonnes"><span class="user__pseudo bold"><?= $nbrFollower ?></span> abonnés</a>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn__tab active" data-target="tweet">Tweets</button>
                    </div>
                </div>
            </div>
            <?php include_once "../Public/Elements/emojis.html"; ?>
            <!--liste tweet de l'user courant-->
            <div id="toto">
                <?php include_once '../Private/update-tweet.php'?>
            </div>
        </div>

        <?php include_once '../Public/Elements/follow.php'?>

        <?php include_once '../Public/Elements/rightCol.php'?>
    </div>
</div>
<script src="../Public/Jquery/timeline.js"></script>
</body>
</html>