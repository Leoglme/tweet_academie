$("document").ready(function(){
    /*Focus input box shadow*/
    let input = $("input");
    input.on('focus', function(){
        let cible = $($(this).parents()[0]);
        cible.addClass('input__focus');
    })
    input.focusout(function(){
        let cible = $($(this).parents()[0]);
        cible.removeClass('input__focus');
    })

    $("#register_form").submit(function(event){
        event.preventDefault();

        let passRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z\\d]{8,}$");
        // delete all error message and border color!
        $("#loginError").empty()
        $("#passwordError").empty()
        $("#nameError").empty()
        $("#emailError").empty()
        $("#birthdateError").empty()
        $("#descriptionError").empty()

        $('#login__ctn').removeClass('error__log');
        $('#password__ctn').removeClass('error__log');
        $('#name__ctn').removeClass('error__log');
        $('#email__ctn').removeClass('error__log');
        $('#birthDate__ctn').removeClass('error__log');
        $('#description__ctn').removeClass('error__log');

        // verify all data and set error message if something is wrong before send to register
        let isSucces = true;
        
        if($("#login").val().length < 6 || $("#login").val().length > 30) { 
            $('#loginError').text("minimum 6 caractères, caractères spéciaux autorisés (- et _) !");
            $('#login__ctn').addClass('error__log');
            isSucces = false;
        }

        if($("#password").val().length < 8 || !passRegex.test($("#password").val())) {
            $('#passwordError').text("minimum 8 caractères une majuscule une minuscule un chiffre!");
            $('#password__ctn').addClass('error__log');
            isSucces = false;
        } else if ($("#password").val().length > 30 && !passRegex.test($("#password").val())) {
            $('#passwordError').text("maximum 30 caractères une majuscule une minuscule un chiffre!");
            $('#password__ctn').addClass('error__log');
            isSucces = false;
        }

        if($("#name").val().length < 2 || $("#name").val().length > 100) { 
            $('#nameError').text("minimum 2 caractères et maximum 100 caractères !");
            $('#name__ctn').addClass('error__log');
            isSucces = false;
        }

        if($("#email").val().length < 5 || $("#email").val().length > 60) { 
            $('#emailError').text("votre e-mail n'est pas valide !");
            $('#email__ctn').addClass('error__log');
            isSucces = false;
        }

        if($("#description").val().length < 8 || $("#description").val().length > 255) { 
            $('#descriptionError').text("8 à 255 caractères !");
            $('#description__ctn').addClass('error__log');
            isSucces = false;
        }

        if($("#birthDate").val().length < 10 || $("#birthDate").val().length > 10) {
            $('#birthdateError').text("Date de naissance invalide !");
            $('#birthDate__ctn').addClass('error__log');
            isSucces = false;
        }
        //all is good send it to back
        if (isSucces) {

            let formData = {
                login: $("#login").val(),
                password: $("#password").val(),
                name: $("#name").val(),
                email: $("#email").val(),
                birthDate: $("#birthDate").val(),
                description: $("#description").val(),
            }
            
            $.ajax( {
                type: "POST",
                url: "../private/register_query.php",
                data: {myData: formData},
                dataType: "json",
        
                success:function(data) {
                    // if all input needed are good redirect
                    if (data["success"] === true) {
                        setTimeout(function(){
                            redirection()
                        },1000);
                    
                    // if a input needed are wrong or exist write error message
                    } else if (data["success"] === false) {
                        console.log(data);
                        if (data["isName"] === false) {

                            $('#nameError').text("Nom, prénom invalide!");
                            $('#birthDate__ctn').addClass('error__log');
                        } else {
                            $('#nameError').text("");
                            $('#birthDate__ctn').removeClass('error__log');
                        }

                        if (data["isLogin"] === false) {
                            
                            $('#loginError').text("login invalide!");
                            $('#login__ctn').addClass('error__log');
                        } else {
                            $('#loginError').text("");
                            $('#login__ctn').removeClass('error__log');
                        }
                        
                        if (data["isPassword"] === false) {
                           
                            $('#passwordError').text("password invalide!");
                            $('#password__ctn').addClass('error__log');
                        } else {
                            $('#passwordError').text("");
                            $('#password__ctn').removeClass('error__log');
                        }
                        
                        if (data["isEmail"] === false) {
                            
                            $('#emailError').text("email invalide!");
                            $('#email__ctn').addClass('error__log');
                        } else {
                            $('#emailError').text("");
                            $('#email__ctn').removeClass('error__log');
                        }
                        
                        if (data["isBirthDate"] === false) {
                            
                            $('#birthdateError').text("date de naissance invalide!");
                            $('#birthDate__ctn').addClass('error__log');
                        } else {
                            $('#birthdateError').text("");
                            $('#birthDate__ctn').removeClass('error__log');
                        }
                        
                        if (data["isDescription"] === false) {

                            $('#descriptionError').text("description invalide!");
                            $('#description__ctn').addClass('error__log');
                        } else {
                            $('#descriptionError').text("");
                            $('#description__ctn').removeClass('error__log');
                        }

                        if (data["mailExist"] === true) {
                            $('#emailError').text("email invalide!");
                            $('#email__ctn').addClass('error__log');
                        } else {
                            $('#emailError').text("");
                            $('#email__ctn').removeClass('error__log');
                        }

                        if (data["loginExist"] === true) {
                    
                            $('#loginError').text("login invalide!");
                            $('#login__ctn').addClass('error__log');
                        } else {
                            $('#loginError').text("");
                            $('#login__ctn').removeClass('error__log');
                        }
                    }
                    
                    function redirection() {
                        window.location.href = '../Connexion';
                    }
                },

                error: function (xhr, status, error) {
                    console.log("errorjs");
                    console.log(xhr);
                    console.log("l'ajout du membre a échoué, " + xhr.responseText );
                    console.log(error);
                }
            });
        }
    });
});