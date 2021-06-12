<!DOCTYPE html>
<?php include_once '../Public/Elements/sessionIsActiver.php';
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
    <script src="../Public/Jquery/scrollingMenu.js"></script>
    <script src="../Public/Jquery/addTweet.js"></script>
    <script src="../Public/Jquery/update-tweet.js"></script>
    <script src="../Public/Jquery/emojis.js"></script>
    <script src="../Public/Jquery/searchBarre.js"></script>
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
                         src="../Public/assets/images/default_profile_400x400.png" alt="photo profil user">
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
<div class="container-fluid" style="min-height: 100vh">
    <div class="row">
        <?php include_once '../Public/Elements/leftCol.php'?>
        <div class="col tweet__feed">
            <div class="row item__border p-0">
                <div class="left__col--item">
                    <a href="../" class="fas fa-arrow-left"></a>
                </div>
                <div class="search__tweet--header">
                    <div class="input-group">
                        <div class="form-outline">
                            <i class="fas fa-search"></i>
                            <input type="search" id="form2" class="form-control search__tweet"
                                   placeholder="Recherche Tweet">
                            <label for="form2"></label>
                        </div>
                    </div>
                </div>

                <div class="tab__panel">
                    <button class="btn btn__tab active" data-target="tweet">Tweets</button>
                    <button class="btn btn__tab" data-target="people">Personnes</button>
                </div>
            </div>

            <!--liste résultat de la recherche -->
            <div id="resultTweet">
                <div id="searchHashtag">
                </div>
            </div>
            <div id="resultUser">
                <div id="searchUser">
                </div>
            </div>


        </div>

        <?php include_once '../Public/Elements/rightCol.php'?>
    </div>
</div>


<script src="../Public/Jquery/timeline.js"></script>
</body>

</html>