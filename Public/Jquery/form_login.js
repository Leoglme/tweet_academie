$(document).ready(function () {

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


    $("#login_form").submit(function(e){
        e.preventDefault();
        let passRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z\\d]{8,}$");
        let isSuccess = true;

        $("#loginError").empty()
        $('#login__ctn').removeClass('error__log');
        $('#password__ctn').removeClass('error__log');

        if ($("#login").val().length < 6 || ($("#password").val().length < 8 || !passRegex.test($("#password").val()))) {
            $('#login__ctn').addClass('error__log');
            $('#password__ctn').addClass('error__log');
            $("#loginError").text("Login ou mot de passe incorrect");
            isSuccess = false;
        }

        if (isSuccess) {

            let formData = {
                login: $("#login").val(),
                password: $("#password").val(),
            }

            $.ajax( {
                type: "POST",
                url: "../Private/form_login.php",
                data: {myData: formData},
                dataType: "json",

                success:function(data) {
                    // if all input needed are good redirect
                    if (data["success"] === true) {
                        console.log("reussi !!!!!!!!!!!!!");
                        setTimeout(function(){
                            redirection()
                        },1000);

                        // if a input needed are wrong or exist write error message
                    } else if (data["success"] === false) {
                        $('#login__ctn').addClass('error__log');
                        $('#password__ctn').addClass('error__log');
                        $("#loginError").text("Login ou mot de passe incorrect");
                    }

                    function redirection() {
                        window.location.href = '../';
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