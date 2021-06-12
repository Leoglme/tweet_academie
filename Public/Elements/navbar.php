<?php
$filename = "../../" . explode("/", $_SERVER["PHP_SELF"])[1];
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
} else {
    $name = "Prénom Nom";
}
?>

<header>
    <div class="navbar__header">
        <a href="../<?= $filename ?>">
            <img class="tweetWac__logo" src="<?= $filename ?>/Public/assets/images/logo_tweetWac.png"
                 alt="logo Tweeter Académie">
        </a>

        <!-- Overlay menu profil -->
        <div class="profil__overlay">
        <span class="rounded__overlay">
            <img class="rounded__img" alt="profil image" src="<?= $filename ?>/Public/assets/images/men_logo.png">
        </span>
            <span class="profil__overlay--name"><?= $name ?></span>
            <div class="dropdown-menu profil__menu">
                <a href="<?= $filename ?>/Profil/?pseudo=" class="dropdown-item">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    <span class="ml-1">Mon profil</span>
                </a>
                <a href="" class="dropdown-item liste__timeline">
                    <img class="bird__icon" src="<?= $filename ?>/Public/assets/images/logo-onglet.png"
                         style="max-width: 20px" alt="bird icon">
                    <span class="ml-1">Timeline</span>
                </a>
                <!-- Switch thèmes -->

                <div class="toggleWrapper dropdown-item">
                    <input type="checkbox" id="switch">
                    <label for="switch" class="toggle switch__mode">
                        <span class="toggle__handler">
                        </span>
                        <span class="item item__1"></span>
                        <span class="item item__2"></span>
                        <span class="item item__3"></span>
                        <span class="item item__4"></span>
                        <span class="item item__5"></span>
                        <span class="item item__6"></span>
                    </label>
                    <span class="ml-1 mr-auto">Thème sombre</span>
                    <i class="fas fa-moon"></i>
                </div>



                <div class="dropdown-divider"></div>
                <a class="dropdown-item disconnect__account">
                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                    <span class="ml-1">Se déconnecter</span>
                </a>
            </div>
        </div>
    </div>
</header>

<div class="modal modal__disconnect" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal__disconnect--content">
            <div class="modal-header">
                <span class="modal-title" id="mod_lab_2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="ml-2">Se déconnecter ?</span>
                </span>
            </div>
            <div class="modal-body">
                <p>Voulez vous vraiment vous déconnecter de Tweet Académie ?</p>
            </div>
            <div class="modal-footer">
                <a href="<?= $filename ?>/Private/disconnect.php" class="btn btn-blue">Oui</a>
                <button type="button" class="btn btn-secondary close__modal">Non</button>
            </div>
        </div>
    </div>
</div>