$(document).ready(function () {
    let urlSource = $(location)[0].origin + '/Tweeter/';

    let btn = 0;
    $("html").css("overflow-y", "visible");

    $(".btn__retweet").on("click", function (event) {
        btn = $(this).attr("data-target");
        event.preventDefault();

        let replyData = {
            fkIdTweet: btn ,
        }

        $.ajax({
            url: urlSource + 'Private/retweet.php',
            type: 'POST',
            async:false,
            data: {myData: replyData},
            dataType: 'json',
            success: function (data) {

                console.log(data["success"]);
                if (data["success"] === true) {
                    console.log("reussi");
                    $("html").css("overflow-y", "visible");
                    window.location.reload(true);
                }
            },

            complete: function () {
                console.log("passé complete");
                $("html").css("overflow-y", "visible");
            },

            error: function (xhr, status, error) {
                console.log("errorjs");
                console.log(xhr);
                console.log("la reponse tweet a échoué, " + xhr.responseText);
                console.log(error);
            }
        });
    });
});