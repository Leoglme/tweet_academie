$(document).ready(function () {

    $.ajax({
        url: '../Private/follow.php',
        type: 'POST',
        async:false,
        data: {followed: $("#followed").val(),
        },
        dataType: 'json',
        success: function (data) {

            if (data["success"] === true) {
                if($(".user__banner--info").length) {
                    data["follow"] === true ? $("#follow").removeClass("btn__follow").addClass("btn__follow--on") : $("#follow").removeClass("btn__follow--on").addClass("btn__follow");
                }
            }
        },
        complete: function () {
            console.log("passé complete");
        },

        error: function (xhr, status, error) {
            console.log("errorjs");
            console.log(xhr);
            console.log("la reponse tweet a échoué, " + xhr.responseText);
            console.log(error);
        }
    });

    if($(".user__banner--info").length) {
        $("#follow").on("click", function (event) {
            event.preventDefault();
            sendToPhp('../Private/follow.php', $("#followed").val());
        });
    }

    if($("#following").length) {
        $(document).on('click', '.btn__follow--on', function () {
            console.log($(this).attr("data-target"));
            sendToPhp('../Private/follow.php', $(this).attr("data-target"));
        });
    }

    if($("#followers").length) {
        $(document).on('click', '.btn__follow', function () {
            console.log($(this).attr("data-target"));
            sendToPhp('../Private/follow.php', $(this).attr("data-target"));
        });
    }

    function sendToPhp(url, login) {
        console.log("sendphp");
        $.ajax({
            url: url,
            type: 'POST',
            async:false,
            data: {followed: login,
                clicked: true
            },
            dataType: 'json',
            success: function (data) {

                console.log(data["success"]);
                if (data["success"] === true) {

                    console.log(data["follow"]);
                    data["follow"] === true ? $("#follow").removeClass("btn__follow").addClass("btn__follow--on") : $("#follow").removeClass("btn__follow--on").addClass("btn__follow");
                    console.log("reussi");
                    window.location.reload(true);
                }
                console.log(data);
            },
            complete: function () {
                console.log("passé complete");
            },

            error: function (xhr, status, error) {
                console.log("errorjs");
                console.log(xhr);
                console.log("la reponse tweet a échoué, " + xhr.responseText);
                console.log(error);
            }
        });
    }
});