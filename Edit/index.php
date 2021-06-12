<?php
$filename = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];
include_once '../Public/Elements/sessionIsActiver.php';
include_once '../Private/getInfo.php';
include_once '../Private/dbConnect.php';
$dB = dbConnect::connect();
$obj = new GetInfo($dB);
$countTweet = $obj->countUserTweet($_SESSION['login']);
$registerDate = $obj->getDateRegister($_SESSION['login']);
$userInfos = $obj->getAllUserInfos($_SESSION['login']);
?>

<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?= $_SESSION['name'] . " (@" . $_SESSION['login'] . ")" ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/054fdad312.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../Public/Jquery/scrollingMenu.js"></script>
    <script src="../Public/Jquery/timeline.js"></script>
    <script src="../Public/Jquery/update-profil.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/CSS/style.css">
    <link rel="icon" href="../Public/assets/images/logo-onglet.png">
</head>
<body>
<?php include_once "../Public/Elements/navbar.php"; ?>
<!--Partie Message de bienvenue / Second header -->
<div class="welcome">
    <span class="mask__background"></span>
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="welcome__text col-lg-7 col-md-10">
                <h1 class="welcome__titre">Hello <i class="fas fa-at"
                                                    style="font-size: 35px;"></i><?= $_SESSION['login'] ?></h1>
                <p class="text-white mt-0 mb-5">Voici la page de gestion ton compte, ici tu peux modifier et
                    avoir un
                    aperçu de ton profil sur Tweeter, bonne et agréable expérience sur le site </p>
                <form id="update-form" method="post" action="" role="form">
                    <button type="submit" class="btn btn-info btn__default" id="btnSubmit">Valider le profil</button>
            </div>
        </div>
    </div>
</div>

<!--Partie edition profil-->
<div class="container-fluid edit__container">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card" style="border-color: #c4cfd6 !important;">
                <!--Partie Apercu profil-->
                <div class="row item__border border-bottom-0">
                    <div class="user__banner">
                        <div class="user__banner--info">
                            <div class="user_image--lg" style="background: url('<?= $filename ?>/Public/assets/images/default_profile_400x400.png');"></div>
                        </div>
                    </div>

                    <div>
                        <div class="profil__tweet--header" style="line-height: 25px; padding-left: 5px;">
                            <h1 class="user__name--bold"><?= $_SESSION['name'] ?></h1>
                            <p class="user__pseudo">@<?= $_SESSION['login'] ?></p>
                            <p class="user__pseudo mt-2"><i class="far fa-calendar-alt"></i> A rejoint Twitter en <?= $registerDate ?></p>
                            <p class="user__pseudo tweet_message mt-2"><?= $userInfos['description'] ?></p>
                            <div class="mb-4">
                                <a class="user__pseudo mr-3" id="abonnements"><span class="user__pseudo bold">53</span> abonnements</a>
                                <a class="user__pseudo" id="abonnes"><span class="user__pseudo bold">4</span> abonnés</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 order-xl-1">
            <div class="card card__compte">
                <div class="card-header border-0 header__compte">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="user__name">Mon compte</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <!-- FORMULAIRE MODIF -->

                    <h6 class="heading-small text-muted mb-4">Informations profil</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="name">Prénom Nom</label>
                                    <input name="firstname" type="text" class="form-control form__edit" id="name"
                                           autocomplete="off" value="<?= $userInfos['name'] ?>">
                                    <p class="input__error-msg"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="date">Date</label>
                                    <input class="form-control form__edit" name="birth" type="date" value="<?= $userInfos["date_naissance"] ?>"
                                           id="birthDate">
                                    <p class="input__error-msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4 line__info--profil">
                    <h6 class="heading-small text-muted mb-4">Informations utilisateur</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="email">Email</label>
                                    <input type="text" name="email" class="form-control form__edit" id="email"
                                           value="<?= $userInfos["mail"] ?>">
                                    <p class="input__error-msg"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="password">Mot de passe</label>
                                    <input type="password" name="password" class="form-control form__edit" id="mdp"
                                           autocomplete="off" placeholder="Nouveau mot de passe">
                                    <p class="input__error-msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <!-- Description -->
                    <h6 class="heading-small text-muted mb-4">Un peu plus sur toi</h6>
                    <div class="pl-lg-4">
                        <div class="form-group focused">
                            <label class="form-control-label" for="description">Description</label>
                            <textarea rows="4" name="description" id="description"
                                      class="form-control form__edit"><?= $userInfos['description'] ?></textarea>
                            <p class="input__error-msg"></p>
                        </div>
                    </div>
<!--                    </form>-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once '../Public/Elements/footer.php' ?>
</body>
</html>