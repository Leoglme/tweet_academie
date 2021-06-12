$(document).ready(function () {
    //let urlSource = $(location)[0].origin + '/Tweeter/';
    let btn = 0;

    $(".btn__reply").on("click", function() {

        btn = $(this).attr("data-target");
        $("#fk_tweet").val(btn);
        let viewTweet = {
            fkIdTweet: btn,
        }

        $.ajax({

            //url: urlSource + 'Private/tweetView_reply.php',
            url: 'Private/tweetView_reply.php',
            type: 'POST',
            data: {myData: viewTweet},
            async: false,
            dataType: 'json',
            success: function (data) {

                $("#currentTweet").text(data["tweet"]);
            },

            error: function (xhr, status, error) {
                console.log("errorjs");
                console.log(xhr);
                console.log("la reponse tweet a échoué, " + xhr.responseText );
                console.log(error);
            }
        });

        $(".bg-reply").fadeIn(200);
        $("html").css("overflow-y", "hidden");
    })

    $('.new__tweet').on('click', function (e) {
        if( !$(e.target).is("button") && !$(e.target).is("i")) {
            let fk_id = $(this).children().val();
            let url = "TweetView/index.php?id=" + fk_id;
            window.location.href = url;
        }
    });

// bouton close dans le modal
    $(".tweet__modal--close").on("click", function () {
        $(".emojiPickerModal").fadeOut(200);
        $(".bg-reply").fadeOut(200);
        $("html").css("overflow-y", "scroll");
    })

// close modal avec touche Echap
    $(document).keyup(function (e) {
        if (e.key === "Escape") {
            $(".emojiPickerModal").fadeOut(200);
            $(".bg-reply").fadeOut(200);
            $("html").css("overflow-y", "visible");
        }
    });

    // close en cliquant en dehors du modal
    $(document).mouseup(function (e) {
        let poppins = $(".reply__modal");
        let emojiPicker = $(".emojiPickerModal");
        if (!poppins.is(e.target) && !emojiPicker.is(e.target) && poppins.has(e.target).length === 0 && emojiPicker.has(e.target).length === 0) {
            $(".bg-reply").hide();
            emojiPicker.hide();
        } else {
            $(".bg-reply").show();
        }
    });
    //send value textarea

        $("#sendReply.add__tweet--btn").on("click", function (event) {

            event.preventDefault()
            let replyTweet = $("#replyTweet").val().trim();

            let replyData = {
                fkIdTweet: $("#fk_tweet").val(),
                replyTweet: replyTweet,
            }
            if (replyTweet === '') {
                return;
            }

            $.ajax({
                url: 'Private/tweet_reply.php',
                type: 'POST',
                async:false,
                data: {myData: replyData},
                dataType: 'json',
                success: function (data) {

                    console.log(data["success"]);
                    if (data["success"] === true) {
                        $('#replyTweet').text("");
                        $(".bg-reply").fadeOut(200);
                        $(".emojiPicker").fadeOut(200);
                        $("html").css("overflow-y", "visible");
                        window.location.reload(true);

                        console.log("reussi");
                    }
                    console.log(data);
                },
                complete: function () {
                    console.log("passé complete");
                    $('#replyTweet').val("");
                    $(".modal").fadeOut(200);
                    $(".emojiPicker").fadeOut(200);
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

    /*Get # dans un tweet et ajoute span + couleur*/
    function getHashtags() {
        $('.tweet_message').html(function () {
            return $(this).text().replace(/(#(\w+))/g, "<a href= 'localhost/Tweeter/hashtag.php?toto=$2'>$1</a>");
        });
    }

    /*supprime enter temps réel espace multiples*/
    $(function () {
        let txt = $("#newTweetHome");
        let func = function () {
            txt.val(txt.val().replace(/\s\s+/g, ' '));
        }
        txt.keyup(func).blur(func);
    });
});