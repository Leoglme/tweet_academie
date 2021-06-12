<!DOCTYPE html>
<?php include_once 'Public/Elements/sessionIsActiver.php';
if (isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
} else {
    $name = "Prénom Nom";
}
?>

<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>TweetAcadémie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/054fdad312.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="Public/Jquery/scrollingMenu.js"></script>
    <script src="Public/Jquery/addTweet.js"></script>
    <script src="Public/Jquery/update-tweet.js"></script>
    <script src="Public/Jquery/emojis.js"></script>
    <script src="Public/Jquery/searchBarre.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/style.css">
    <link rel="icon" href="Public/assets/images/logo-onglet.png">
</head>
<body>
<?php include_once "Public/Elements/navbar.php"; ?>

<!-- MODAL TWEET -->
<div class="modal bg-poppins" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content tweet__modal">
            <div class="modal-header tweet__modal--header">
                <i class="fas fa-times tweet__modal--close"></i>
            </div>
            <div class="modal-body">
                <div class="form-group d-flex">
                    <img class="rounded-circle user_image--apercu"
                         src="Public/assets/images/default_profile_400x400.png" alt="photo profil user" style="height: max-content;">
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
<!-- MODAL REPLY -->
<div class="modal bg-reply" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content reply__modal">
            <div class="modal-header tweet__modal--header">
                <i class="fas fa-times tweet__modal--close"></i>
            </div>
            <div class="modal-body">
                <div class="form-group d-flex">
                    <img class="rounded-circle user_image--apercu img_modal"
                         src="Public/assets/images/default_profile_400x400.png" alt="photo profil user">
                    <div id="currentTweet"></div>

                </div>
                <label for="replyTweet"></label>
                <textarea class="form-control hide__input" id="replyTweet" rows="3"
                          placeholder="Tweeter votre réponse" maxlength="144"></textarea>

                <hr class="divider__sm--sm">
                <div class="left__col--btn footer__modal--sm" style="padding: 8px 0;">
                    <div class="utils">
                        <i class="far fa-smile smile2"></i>
                    </div>
                    <button id="sendReply" class="btn btn-info sm__btn--disabled mr-3 add__tweet--btn" disabled>Reply</button>
                    <input type="hidden" id="fk_tweet" value="">
                </div>
            </div>
            <hr>
            <div class="left__col--btn footer__modal" style="padding: 8px 0;">
                <div class="utils">
                    <i class="far fa-smile smile2"></i>
                </div>
                <button id="sendReply" class="btn btn-info sm__btn--disabled mr-3 add__tweet--btn" disabled>Reply</button>
            </div>
        </div>
    </div>
</div>

<!--<button id="send">Tweet</button>-->
<div class="container-fluid" style="min-height: 100vh">
    <div class="row">
        <?php include_once 'Public/Elements/leftCol.php'?>
        <div class="col tweet__feed">
            <div class="row item__border">
                <h1 class="tweet__feed--title">TimeLine</h1>
            </div>
            <div class="row item__border col__flex">
                <div class="form-group d-flex">
                    <img class="rounded-circle user_image--apercu"
                         src="Public/assets/images/default_profile_400x400.png" alt="photo profil user">
                    <label for="newTweetHome"></label>
                    <textarea class="form-control hide__input" id="newTweetHome" rows="1"
                              placeholder="Que veux tu partager ?" maxlength="144"></textarea>
                </div>
                <div class="left__col--btn">
                    <div class="utils">
                        <i class="far fa-smile smile1"></i>
                        <?php include_once "Public/Elements/emojis.html"; ?>
                    </div>
                    <button id="button-tweet" class="btn btn-info sm__btn--disabled add__tweet--btn" disabled>Tweet</button>
                </div>
            </div>

            <!--liste tweet-->
            <div id="toto">
                <?php include_once 'Private/update-tweet.php'?>
            </div>

        </div>

        <?php include_once 'Public/Elements/rightCol.php'?>
    </div>
</div>



<script src="Public/Jquery/timeline.js"></script>
</body>

</html>