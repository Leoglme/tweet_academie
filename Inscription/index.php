<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>TweetAcadémie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/054fdad312.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!--<script src="../Public/Jquery/scrollingMenu.js"></script>-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/CSS/style.css">
    <link rel="icon" href="../Public/assets/images/logo-onglet.png">
</head>
<body>
<?php session_start(); ?>
<main class="">
    <div class="container-fluid bg__register--img" style="background-size: cover;">
        <div class="row" style="flex-direction: column; max-width: 465px;">
            <div class="title">
                <div style="text-align: center; margin-bottom: 40px;">
                    <img src="../Public/assets/images/logo-onglet.png" alt="" style="width: 60px;">
                </div>
                <h3><span class="title--firstLetter">C</span>réer votre compte Tweeter</h3>
            </div>
                <form id="register_form" class="register" method="post">

                    <div class="input__container" id="login__ctn">
                        <label for="login" class="register-label">Login :</label>
                        <input name="login" type="text" class="register-input" id="login">
                    </div>
                    <span id="loginError" class="comments"></span>

                    <div class="input__container" id="password__ctn">
                        <label for="password" class="register-label">Mot de passe :</label>
                        <input name="password" type="password" class="register-input" id="password">
                    </div>
                    <span id="passwordError" class="comments"></span>

                    <div class="input__container" id="name__ctn">
                        <label for="name" class="register-label">Nom ,Prénom :</label>
                        <input name="name" type="text" class="register-input" id="name">
                    </div>
                    <span id="nameError" class="comments"></span>

                    <div class="input__container" id="email__ctn">
                        <label for="email" class="register-label">E-mail :</label>
                        <input name="email" type="text" class="register-input" id="email">
                    </div>
                    <span id="emailError" class="comments"></span>

                    <div class="input__container" id="birthDate__ctn">
                        <label for="birthDate" class="register-label">Date de naissance :</label>
                        <input name="birthDate" type="date" class="register-input input--birthDate" id="birthDate">
                    </div>
                    <span id="birthdateError" class="comments"></span>

                    <div class="input__container" id="description__ctn">
                        <label for="description" class="register-label">Description :</label>
                        <textarea id="description" class="register-textArea" name="description" rows="3" cols="33"></textarea>
                    </div>
                    <span id="descriptionError" class="comments"></span>

                    <button type="submit" class="btn btn-info mt-3">Se connecter</button>
                </form>
            <a href="../Connexion" class="register--link">Se connecter sur Tweeter</a>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <script src="../Public/Jquery/form_register.js"></script>
</main>
</body>
</html>