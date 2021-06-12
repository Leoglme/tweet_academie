<?php $filename = dirname(__DIR__, 2);
$path = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];
include_once $filename . '/Private/dbConnect.php';
include_once $filename.'/Private/getInfo.php';

$baseFolder = explode("\\", getcwd());
$count = count(explode("\\", getcwd())) - 1;
$baseFolder = $baseFolder[$count];

//var_dump($filename . '/private/getInfo.php') ;
$getRecent = new GetInfo(dbConnect::connect());
?>

<div class="col right__col">
    <div class="right__col--content">
        <div class="input-group" style="<?= $baseFolder === "Search" ? "display: none" : "" ?>">
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
            <?php

            foreach ($getRecent->lastUserTweet() as $value) {
                $pseudo = $value["pseudo"];
                $profilLink = "'$path/Profil/?f=$pseudo'";
                $profilHref = "?f=$pseudo";
                echo '<div class="new__user d-flex" onclick="window.location = '.$profilLink. ' ;">
                                <img class="rounded-circle user_image--apercu ml-3"
                             src="'.$path.'/Public/assets/images/default_profile_400x400.png" alt="photo profil user">
                        <div class="user__infos">
                            <a href="'.$profilHref.'" class="user__name">'.$value["name"].'</a>
                            <p class="user__pseudo">@'.$value["pseudo"].'</p>
                        </div>
                    </div>

                    <hr>';
            }
            ?>
            <div class="suggest__footer"></div>

        </div>

    </div>

</div>
