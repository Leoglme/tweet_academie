<?php $filename = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];
?>
<script src="../Public/Jquery/viewFollow.js"></script>
<script src="../Public/Jquery/follow.js"></script>

<div class="col tweet__feed" id="followPage" style="min-height: 100vh; display: none;">
    <div class="row item__border p-0">
        <div class="left__col--item returnProfil">
            <a class="fas fa-arrow-left"></a>
        </div>
        <div class="profil__tweet--header">
            <h1 class="user__name--bold"><?//= $name[0]["name"] ?></h1>
            <p class="user__pseudo"><?= $countTweet ?> tweet</p>
        </div>
        <div class="tab__panel">
            <button class="btn btn__tab viewFollow" data-target="following">Abonnements</button>
            <button class="btn btn__tab active viewFollow" data-target="follower">Abonnés</button>
        </div>
    </div>

    <!--liste tweet de l'user courant-->
    <div id="following">
            <?php include_once '../Private/update-tweet.php'?>
    </div>

    <div id="followers">

        <div id="toto">
            <?php include_once '../Private/update-tweet.php'?>
        </div>
    </div>
</div>