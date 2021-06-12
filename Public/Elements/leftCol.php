<?php $path = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];

?>

<div class="col left__col">
    <div class="menu__utils">
        <div class="left__col--item" data-location="Tweeter" onclick="window.location = '<?= $path ?>' ;">
            <i class="fas fa-home"></i>
            <p class="item__name">Accueil</p>
        </div>
        <div class="left__col--item" data-location="New" onclick="window.location = '<?= $path . "/New" ?>' ;">
            <i class="far fa-bell"></i>
            <p class="item__name">Notification</p>
        </div>
        <div class="left__col--item" data-location="Messages" onclick="window.location = '<?= $path . "/Messages" ?>' ;">
            <i class="far fa-envelope"></i>
            <p class="item__name">Messages</p>
        </div>
        <div class="left__col--item" data-location="Profil" onclick="window.location = '<?= $path . "/Profil/?f=" . $_SESSION['login'] ?>' ;">
            <i class="far fa-user"></i>
            <p class="item__name">Profil</p>
        </div>
        <div class="left__col--item" data-location="Hashtag" onclick="window.location = '<?= $path . "/Hashtag" ?>' ;">
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


<div class="col left__col--sm">
    <div class="menu__utils--sm">
        <div class="left__col--item" onclick="window.location = '<?= $path ?>' ;">
            <i class="fas fa-home"></i>
            <p class="item__name">Accueil</p>
        </div>
        <div class="left__col--item" onclick="window.location = '<?= $path . "/New" ?>' ;">
            <i class="far fa-bell"></i>
            <p class="item__name">Notification</p>
        </div>
        <div class="left__col--item" onclick="window.location = '<?= $path . "/Messages" ?>' ;">
            <i class="far fa-envelope"></i>
            <p class="item__name">Messages</p>
        </div>
        <div class="left__col--item" onclick="window.location = '<?= $path . "/Profil/?f=" . $_SESSION['login'] ?>' ;">
            <i class="far fa-user"></i>
            <p class="item__name">Profil</p>
        </div>
        <div class="left__col--item" onclick="window.location = '<?= $path . "/Hashtag" ?>' ;">
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