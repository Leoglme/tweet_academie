<?php include_once '../Public/Elements/sessionIsActiver.php';
if (isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
}
$filename = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>TweetAcadémie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/054fdad312.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../Public/Jquery/scrollingMenu.js"></script>
    <!--    <script src="../Public/Jquery/update-tweet.js"></script>-->
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
                    <button id="send" class="btn btn-info sm__btn--disabled mr-3 add__tweet--btn" disabled>Tweet
                    </button>
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
        <?php include_once '../Public/Elements/leftCol.php' ?>
        <div class="col tweet__feed" style="max-width: 450px;">
            <div class="row item__border p-0 message__header">
                <div class="left__col--item">
                    <a href="../" class="fas fa-arrow-left"></a>
                </div>
                <div class="search__tweet--header">
                    <h1 class="suggest__title p-0">Messages</h1>
                </div>
            </div>
            <div class="row item__border p-0 search__messages">
                <div class="search__tweet--header" style="width: 100%;">
                    <div class="input-group">
                        <div class="form-outline">
                            <i class="fas fa-search"></i>
                            <input type="search" id="form1" class="form-control search__tweet"
                                   placeholder="Recherche Tweet">
                            <label for="form1"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="toto">
                <?php include_once '../Private/update-tweet.php' ?>

                <div class="new__tweet item__border row">
                    <a href="<?= $filename ?>/Profil">
                        <img class="rounded-circle user_image--apercu"
                             src="<?= $filename ?>/Public/assets/images/default_profile_400x400.png"
                             alt="photo profil user">
                    </a>

                    <div style="margin-left: 10px; width: 100%;">
                        <div class="d-flex" style="justify-content: space-between">
                            <div class="d-flex">
                                <div>
                                    <a href="<?= $filename ?>/Profil" class="user__name">Prénom Nom</a>
                                    <p class="user__pseudo">@pseudo</p>
                                </div>
                            </div>
                            <button class="add__msg--btn"><i class="far fa-envelope"></i><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End timeline-->

        <!--Aucun messages-->
        <div class="col right__col messages__result" style="display: none;">
            <div class="right__col--content">
                <div class="suggest__msg">
                    <h1 class="suggest__title">Aucun message n'est sélectionné.</h1>
                    <p class="user__pseudo mt-2">Choisissez-en un dans vos messages existants, ou commencez-en un
                        nouveau.</p>
                </div>
            </div>
        </div>

        <!--Messages content-->
        <div class="col right__col right__col--msg">
            <div class="row item__border p-0 message__header">
                <div class="search__tweet--header header__msg">
                    <a href="<?= $filename ?>/Profil">
                        <img class="rounded-circle user_image--apercu"
                             src="<?= $filename ?>/Public/assets/images/default_profile_400x400.png"
                             alt="photo profil user">
                    </a>

                    <div style="margin-left: 10px; width: 100%;">
                        <div class="d-flex" style="justify-content: space-between">
                            <div class="d-flex">
                                <div>
                                    <a href="<?= $filename ?>/Profil" class="user__name">Prénom Nom</a>
                                    <p class="user__pseudo">@pseudo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column__feed">
                <div class="message__send--ctn">
                    <div class="message__send"><span>Bidule chouette</span></div>
                </div>

                <div class="message__receive--ctn">
                    <div class="message__receive"><span>word-break: break-word;word-break: break-word;</span></div>
                </div>

                <div class="message__send--ctn">
                    <div class="message__send"><span>Bidule chouette</span></div>
                </div>

                <div class="message__receive--ctn">
                    <div class="message__receive"><span>word-break: break-word;word-break: break-word;</span></div>
                </div>
            </div>

            <div id="input_messages" class="row item__border col__flex">
                <div class="form-group d-flex">
                    <label for="new__message"></label>
                    <textarea class="form-control hide__input" id="new__message" rows="1"
                              placeholder="Démarrer un nouveau message" maxlength="144"></textarea>
                </div>
                <div class="left__col--btn">
                    <div class="utils">
                        <i class="far fa-smile smile1"></i>
                        <?php include_once "../Public/Elements/emojis.html"; ?>
                    </div>
                    <button id="send_message" class="btn btn-info sm__btn--disabled" style="width: 110px;" disabled>Envoyer<i class="fas fa-paper-plane ml-1"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="../Public/Jquery/timeline.js"></script>
</body>

</html>