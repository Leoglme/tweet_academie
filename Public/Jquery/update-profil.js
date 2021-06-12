$(document).ready(function () {

    $('#btnSubmit').on('click', function (e) {
            e.preventDefault();

            let passRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

            // delete all error message and border color!

            $(".input__error-msg").html("");

            // verify all data and set error message if something is wrong before send to register
            let isSucces = true;

            if ($("#mdp").val().length < 8 && !passRegex.test($("#mdp").val())) {
                $('#mdp + .input__error-msg').text("minimum 8 caractères une majuscule une minuscule un chiffre!");
                isSucces = false;
            } else if ($("#mdp").val().length > 30 && !passRegex.test($("#password").val())) {
                $('#mdp .input__error-msg').text("maximum 30 caractères une majuscule une minuscule un chiffre!");
                isSucces = false;
            }

            if ($("#name").val().length < 2 || $("#name").val().length > 100) {
                $('#name + .input__error-msg').text("minimum 2 caractères et maximum 100 caractères !");
                isSucces = false;
            }

            if ($("#email").val().length < 5 || $("#email").val().length > 60) {
                $('#email + .input__error-msg').text("votre e-mail n'est pas valide !");
                isSucces = false;
            }

            if ($("#description").val().length < 8 || $("#description").val().length > 255) {
                $('#description + .input__error-msg').text("8 à 255 caractères !");
                isSucces = false;
            }

            if ($("#birthDate").val().length < 10 || $("#birthDate").val().length > 10) {
                $('#birthDate + .input__error-msg').text("Date de naissance invalide !");
                isSucces = false;
            }
            // all is good send it to back
            if (isSucces) {

                let arrayUpdate = {

                    name: $("#name").val(),
                    password: $("#mdp").val(),
                    email: $("#email").val(),
                    birthDate: $("#birthDate").val(),
                    description: $("#description").val()
                }

                $.ajax({

                    type: "POST",
                    url: "../Private/update-profil.php",
                    data:
                        {
                            arrayUpdate: arrayUpdate
                        },
                    dataType: "json",

                    success: function (data) {
                        console.log('réussi');
                        if (data["success"] === true) {
                            console.log('réussi');
                            $(".user__name--bold").text(data["name"]);
                            $(".user__pseudo + .tweet_message").text(data["description"]);
                            $("#name").val(data["name"]);
                            $("#mdp").val(data["password"]);
                            $("#description").val(data["description"]);
                            $("#birthDate").val(data["birthDate"]);
                            $("#email").val(data["email"]);

                            // if a input needed are wrong or exist write error message
                        } else if (data["success"] === false) {

                            if (data["isName"] === false) {
                                console.log(data);
                                $('#name + .input__error-msg').text("Nom, prénom invalide!");
                                $('#name').css('border-color', 'red');
                            } else {
                                $('#name + .input__error-msg').text("");
                                $('#name').css('border-color', '');
                            }
                            if (data["isPassword"] === false) {

                                $('#mdp + .input__error-msg').text("password invalide!");
                                $('#mdp').css('border-color', 'red');
                            } else {
                                $('#mdp + .input__error-msg').text("");
                                $('#mdp').css('border-color', '');
                            }

                            if (data["isEmail"] === false) {
                                $('#email + .input__error-msg').text("email invalide!");
                                $('#email').css('border-color', 'red');
                            } else {
                                $('#email + .input__error-msg').text("");
                                $('#email').css('border-color', '');
                            }

                            if (data["isBirthDate"] === false) {

                                $('#birthDate + .input__error-msg').text("date de naissance invalide!");
                                $('#birthDate').css('border-color', 'red');
                            } else {
                                $('#birthDate + .input__error-msg').text("");
                                $('#birthDate').css('border-color', '');
                            }

                            if (data["isDescription"] === false) {

                                $('#description + .input__error-msg').text("description invalide!");
                                $('#description').css('border-color', 'red');
                            } else {
                                $('#description + .input__error-msg').text("");
                                $('#description').css('border-color', 'red');
                            }

                            if (data["mailExist"] === true) {

                                $('#email + .input__error-msg').text("email invalide!");
                                $('#email').css('border-color', 'red');
                            } else if (data['isEmail'] === true && data["mailExist"] === true) {
                                $('#email + .input__error-msg').text("");
                                $('#email').css('border-color', '');
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("errorjs");
                        console.log(xhr);
                        console.log("l'ajout du membre a échoué, " + xhr.responseText);
                        console.log(error);
                    }
                });
            }
        }
    );
});