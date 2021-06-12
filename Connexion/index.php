<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Se connecter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/054fdad312.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/CSS/style.css">
    <link rel="icon" href="../Public/assets/images/logo-onglet.png">
</head>
<body>
<main class="">
    <div class="container-fluid bg__register--img decal--top">
        <div class="row" style="flex-direction: column; margin-top: 100px;">
                <div class="title">
                    <div style="text-align: center; margin-bottom: 40px;">
                        <img src="../Public/assets/images/logo-onglet.png" alt="" style="width: 60px;">
                    </div>
                    <h3><span class="title--firstLetter">S</span>e connecter à Tweeter</h3>
                </div>
                <form id="login_form" class="connexion" method="post">
                    <div class="space"></div>
                    <div class="input__container" id="login__ctn">
                        <label for="login" class="connexion-label">Login :</label>
                        <input type="text" name="login" id="login" class="connexion-input">
                    </div>


                    <div class="space"></div>
                    <div class="input__container" id="password__ctn">
                        <label for="password" class="connexion-label">Mot de passe :</label>
                        <input type="password" name="password" id="password" class="connexion-input">
                    </div>

                    <span id="loginError" class="comments"></span>
                    <button type="submit" id="btn_connexion"  class="btn btn-info mt-3">Se connecter</button>
                </form>
                <a href="../Inscription" class="connexion--link">S'inscrire sur Tweeter</a>
            <div class="col-sm-3"></div>
        </div>
    </div>

    <script src="../Public/Jquery/form_login.js"></script>
</main>
</body>
</html>