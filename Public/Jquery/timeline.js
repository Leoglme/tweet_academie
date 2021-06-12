$("document").ready(function () {
    let currentFile = $(location)[0].pathname.match(/\/(\w+)\/$/)[1];

    //search bar border style => annule le style en cliquant en dehors de la search bar
    $(document).mouseup(function (e) {
        let cible = $('.search__tweet');
        if (!cible.is(e.target) && cible.has(e.target).length === 0) {
            $(".form-outline").removeClass('SearchActive');
        } else {
            $(".form-outline").addClass('SearchActive');
        }
    });

    //augmente la height de textarea HomePage
    function autoHeight($selector){
        $(document).mouseup(function (e) {
            let cible = $($selector);
            if (!cible.is(e.target) && cible.has(e.target).length === 0) {
                cible.css('height', '41px');
            } else {
                cible.css('height', '85px');
            }
        });
    }

    autoHeight('#newTweetHome');
    autoHeight('#new__message');

    // Quand l'user écrit un tweet le btn passe de disable à active
    function rmDisableBtn($input, $btn) {
        $input.on('keyup keydown', updateCount);
        $('.emojiPickerModal, .emojiPicker').on('click', updateCount);

        function updateCount() {
            if ($input.val().length !== 0) {
                $btn.removeClass('sm__btn--disabled');
                $btn.prop("disabled", false);
                $btn.addClass('btn__info--active');
            } else {
                $btn.addClass('sm__btn--disabled');
                $btn.prop("disabled", true);
                $btn.removeClass('btn__info--active');
            }
        }
    }

    rmDisableBtn($('#newTweet'), $('#send.add__tweet--btn'));
    rmDisableBtn($('#newTweetHome'), $('#button-tweet.add__tweet--btn'));
    rmDisableBtn($('#new__message'), $('#send_message'));
    rmDisableBtn($('#replyTweet'), $('#sendReply.add__tweet--btn'));

    /*Tab active function */
    $('.btn__tab').on('click', function () {
        $('.btn__tab').removeClass('active');
        $(this).addClass('active');
        tabElements('tweet', '#resultUser', '#resultTweet');
        tabFollow('following', '.btn__tab', '#following', '#followers');
        tabFollow('follower', '.btn__tab', '#followers', '#following');
    })

    /*Active Tab Elements*/
    function tabElements($target, $tab1, $tab2) {
        if ($('.btn__tab.active').data("target") === $target) {
            $($tab1).css('display', 'none');
            $($tab2).css('display', 'block');
        } else {
            $($tab2).css('display', 'none');
            $($tab1).css('display', 'block');
        }
    }

    tabElements('tweet', '#resultUser', '#resultTweet');

    /*Tab follow profil */
    function defaultTab($selector, add, remove, oldPage = "#profilePage", newPage = "#followPage") {
        $selector.on('click', function () {
            $(oldPage).css('display', 'none');
            $(newPage).css('display', 'block');
            $('.btn__tab[data-target=' + add + ']').addClass('active');
            $('.btn__tab[data-target=' + remove + ']').removeClass('active');

            if (add === 'following'){
                $('#followers').css('display', 'none');
                $('#following').css('display', 'block');
            }else if (add === "follower"){
                $('#following').css('display', 'none');
                $('#followers').css('display', 'block');
            }
        })
    }

    function tabFollow($target, $tab1, $add, $rm){
        let elem = $tab1 + "[data-target='"+$target+"']";

        if ($(elem).hasClass('active')){
            $($rm).css('display', 'none');
            $($add).css('display', 'block');
        }
    }

    defaultTab($('#abonnements'), "following", "follower");
    defaultTab($('#abonnes'), "follower", "following");
    /*Button back profil*/
    defaultTab($('.returnProfil'), "tweet", "follower", "#followPage", "#profilePage");


    /*Button Follow Events*/
    function bidule(){
        $('.btn__follow').on('click', function () {
            $(this).removeClass('btn__follow').addClass('btn__follow--on');
            $('.btn__follow--on').on('click', function () {
                console.log('toto');
                $(this).removeClass('btn__follow--on').addClass('btn__follow');
                bidule();
            })
        })
    }
    bidule();

    /*supprime enter temps réel espace multiples*/
    $(function () {
        let txt = $("#new__message");
        let func = function () {
            txt.val(txt.val().replace(/\s\s+/g, ' '));
        }
        txt.keyup(func).blur(func);
    });

    /*Active leftCOl*/
    $('.left__col--item').removeClass('active');
    $('.left__col--item[data-location= ' + currentFile + ']').addClass('active');
});