<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>TweetFocus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/054fdad312.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../Public/Jquery/scrollingMenu.js"></script>
    <script src="../Public/Jquery/view_replyTweet.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/CSS/style.css">
    <link rel="icon" href="../Public/assets/images/logo-onglet.png">
</head>
<body>
<?php include_once "../Public/Elements/navbar.php"; ?>

<div class="container-fluid" style="min-height: 100vh">
    <div class="row">
        <div class="col left__col">
            <div class="menu__utils">
                <div class="left__col--item">
                    <i class="fas fa-home"></i>
                    <p class="item__name">Accueil</p>
                </div>
                <div class="left__col--item">
                    <i class="far fa-bell"></i>
                    <p class="item__name">Notification</p>
                </div>
                <div class="left__col--item">
                    <i class="far fa-envelope"></i>
                    <p class="item__name">Messages</p>
                </div>
                <div class="left__col--item">
                    <i class="far fa-user"></i>
                    <p class="item__name">Profil</p>
                </div>
                <div class="left__col--item">
                    <i class="fas fa-hashtag"></i>
                    <p class="item__name">Hashtag</p>
                </div>
                <div class="left__col--btn">
                    <button id="button-tweet" class="btn btn-info btn__tweet">Tweet</button>
                    <button id="button-tweet" class="btn btn__tweet--sm"><i class="fas fa-plus"></i><i
                                class="fas fa-feather-alt"></i></button>
                </div>
            </div>
        </div>
        <div class="col tweet__feed">
            <div class="row item__border">
                <h1 class="tweet__feed--title"><i class="fas fa-arrow-left back"></i> Tweet</h1>
            </div>

            <!-- tweet focus and reply on this tweet -->
            <div id="viewReply">
            </div>

        </div>

        <div class="col right__col">
            <div class="right__col--content">
                <div class="input-group">
                    <div class="form-outline">
                        <i class="fas fa-search"></i>
                        <input type="search" id="form1" class="form-control search__tweet"
                               placeholder="Recherche Tweet">
                        <label for="form1"></label>
                    </div>
                </div>
                <div class="suggest">
                    <div class="suggest__header">
                        <h1 class="suggest__title">Ils ont tweet récemment</h1>
                        <!-- user random ou trier par nombre de follow ou par date dernier tweet-->
                    </div>

                    <hr>
                    <div class="new__user d-flex" onclick="window.location='Profil';">
                        <img class="rounded-circle user_image--apercu ml-3"
                             src="../Public/assets/images/default_profile_400x400.png" alt="photo profil user">
                        <div class="user__infos">
                            <a href="../Profil" class="user__name">Prénom nom</a>
                            <p class="user__pseudo">@pseudo</p>
                        </div>
                    </div>

                    <hr>

                    <div class="new__user d-flex" onclick="window.location='Profil';">
                        <img class="rounded-circle user_image--apercu ml-3"
                             src="../Public/assets/images/default_profile_400x400.png" alt="photo profil user">
                        <div class="user__infos">
                            <a href="Profil" class="user__name">Prénom nom</a>
                            <p class="user__pseudo">@pseudo</p>
                        </div>
                    </div>

                    <hr>

                    <div class="new__user d-flex" onclick="window.location='Profil';">
                        <img class="rounded-circle user_image--apercu ml-3"
                             src="Public/assets/images/default_profile_400x400.png" alt="photo profil user">
                        <div class="user__infos">
                            <a href="Profil" class="user__name">Prénom nom</a>
                            <p class="user__pseudo">@pseudo</p>
                        </div>
                    </div>

                    <hr>
                    <div class="suggest__footer"></div>

                </div>

            </div>

        </div>
    </div>
</div>

<div class="col left__col--sm">
    <div class="menu__utils--sm">
        <div class="left__col--item">
            <i class="fas fa-home"></i>
            <p class="item__name">Accueil</p>
        </div>
        <div class="left__col--item">
            <i class="far fa-bell"></i>
            <p class="item__name">Notification</p>
        </div>
        <div class="left__col--item">
            <i class="far fa-envelope"></i>
            <p class="item__name">Messages</p>
        </div>
        <div class="left__col--item">
            <i class="far fa-user"></i>
            <p class="item__name">Profil</p>
        </div>
        <div class="left__col--item">
            <i class="fas fa-hashtag"></i>
            <p class="item__name">Hashtag</p>
        </div>
        <div class="left__col--btn">
            <button id="button-tweet" class="btn btn-info btn__tweet">Tweet</button>
            <button id="button-tweet" class="btn btn__tweet--sm"><i class="fas fa-plus"></i><i
                        class="fas fa-feather-alt"></i></button>
        </div>
    </div>
</div>

<script src="../Public/Jquery/timeline.js"></script>
</body>

</html>