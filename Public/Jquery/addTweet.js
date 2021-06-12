$(document).ready(function () {

    let urlSource = $(location)[0].origin + '/Tweeter/';

    function OpenNewTweet($btn){
        $btn.on("click", function () {
            $(".bg-poppins").fadeIn(200);
            $("html").css("overflow-y", "hidden");
        })
    }
    //open modal tweet
    OpenNewTweet($(".btn__tweet"));

    //open modal tweet mobile
    OpenNewTweet($('.btn__tweet--sm'));



//bouton close dans le modal
    $(".tweet__modal--close").on("click", function () {
        $(".emojiPickerModal").fadeOut(200);
        $(".bg-poppins").fadeOut(200);
        $("html").css("overflow-y", "visible");
    })

// close modal avec touche Echap
    $(document).keyup(function (e) {
        if (e.key === "Escape") {
            $(".emojiPickerModal").fadeOut(200);
            $(".bg-poppins").fadeOut(200);
            $("html").css("overflow-y", "visible");
        }
    });

    //close en cliquant en dehors du modal
    $(document).mouseup(function (e) {
        let poppins = $(".tweet__modal");
        let emojiPicker = $(".emojiPickerModal");
        if (!poppins.is(e.target) && !emojiPicker.is(e.target) && poppins.has(e.target).length === 0 && emojiPicker.has(e.target).length === 0) {
            $(".bg-poppins").hide();
            emojiPicker.hide();
            $("html").css("overflow-y", "visible");
        } else {
            $(".bg-poppins").show();
        }
    });

    //send value textarea
    $(".add__tweet--btn").click(function () {
        let tweet = $("#newTweet").val().trim();
        if (tweet === "") {
            tweet = $("#newTweetHome").val().trim();
        }
        if (tweet === '') {
            return;
        }

        $.ajax({
            url: urlSource + 'Private/tweet_insert.php',
            type: 'POST',
            data: 'text=' + encodeURIComponent(tweet),
            dataType: 'html',
            success: function (code_html) {
                $(code_html).prependTo("#toto");
                getHashtags();
            },
            complete: function () {
                getHashtags();
                $('#newTweetHome').val("");
                $('#newTweet').val("");
                $(".bg-poppins").fadeOut(200);
                $(".emojiPicker").fadeOut(200);
                $("html").css("overflow-y", "visible");
            }
        });
    });



    /*Get # et @ dans un tweet et ajoute span + couleur*/
    function getHashtags(){
        $('.tweet_message').html(function(){
            return $(this).text().replace(/(#(\w+))/g, "<a class='new__hashtag' href= '"+ urlSource +"Hashtag/?q=$2'>$1</a>").replace(/(@(\w+))/g, "<a class='new__mentions' href= '"+ urlSource +"Profil/?f=$2'>$1</a>");
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