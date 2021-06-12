$(document).ready(function () {

    let urlSource = $(location)[0].origin + '/Tweeter/';

    function getParameter(p)
    {
        let url = window.location.search.substring(1);
        let varUrl = url.split('&');
        for (let i = 0; i < varUrl.length; i++)
        {
            let parameter = varUrl[i].split('=');
            if (parameter[0] === p)
            {
                return parameter[1];
            }
        }
    }

    let id = getParameter('id');

    $.ajax( {
        type: "GET",
        url: urlSource + "/Private/tweet_focus_view.php",
        data: {id: id},
        dataType: "json",

        success:function(data) {

            if (data["success"] === true) {
                console.log("reussi !!!!!!!!!!!!!");
                $("#viewReply").append("<div id='boxTweet' class='new__tweet item__border row nwNone'></div><div id='reply'></div>");
                $("#boxTweet").append("<img class='rounded-circle user_image--apercu' src='../Public/assets/images/default_profile_400x400.png'>" +
                    "<div class='margin allBox' style='margin-left: 10px; height: min-content;'></div><p class='tweet_message big_tweet'>" + data['tweet']+ "</p>");
                $(".margin").append("<div id='row' class=''></div>");
                $("#row").append("<div class='box__name'><a href='/Profil' class='user__name'> " + data['name']+ "</a>" +
                    "<p class='user__pseudo ml-1'>@" + data['pseudo']+ " . " +data['date']+ " </p></div>");

                let nbr = 0;
                $.each(data["reply"], function(index, value) {
                    nbr++;
                    $("#reply").append("<div class='boxReply" + nbr + "'></div>");
                    $(".boxReply" + nbr).append("<div class='new__tweet item__border row tweetReply"+ nbr +"'></div>");
                    $('.tweetReply' + nbr).append("<img class='rounded-circle user_image--apercu' src='../Public/assets/images/default_profile_400x400.png'>" +
                        "<div id='marginReply' class='marginReply"+ nbr +"' style='margin-left: 10px;'></div>");
                    $(".marginReply" + nbr).append("<div class='d-flex ReplyFlex"+ nbr +"'></div><div>En Réponse à "+ " @" + data['pseudo'] +
                        " . "+ value['date'] + "</div><p class='tweet_message '>" + value['message'] + "</p>");

                    $(".ReplyFlex"+ nbr).append("<a href='/Profil' class='user__name'> " + value['name'] + "</a>" +
                        "<p class='user__pseudo ml-1'>@" + value['pseudo']+ "</p>");
                });

                // if a input needed are wrong or exist write error message
            } else if (data["success"] === false) {

            }
        },

        error: function (xhr, status, error) {
            console.log("errorjs");
            console.log(xhr);
            console.log("le back a échoué " + xhr.responseText );
            console.log(error);
        }
    });

    $('.back').on('click', function () {
        window.location.href = '../';
    });

});