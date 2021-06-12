$(window).load(function(){

    //open dropdown function
    function openDropdown($selector, $dropdown){
        $($selector).on('click',function(){
            let clicks = $(this).data('clicks');
            if (clicks){
                $($dropdown).fadeOut(200);
            }else{
                $($dropdown).fadeIn(200);
            }
            $(this).data("clicks", !clicks);
        })
    }
    //menu overlay profil
    openDropdown(".profil__overlay" , ".profil__menu");
    openDropdown(".smile1" , ".emojiPicker");
    openDropdown(".smile2" , ".emojiPickerModal");

    //conformation déconnexion du compte
    $(".disconnect__account").on("click",function(){
        $(".modal__disconnect").fadeIn(200);
    })

    //bouton close dans le modal
    $(".close__modal").on("click",function(){
        $(".modal__disconnect").fadeOut(200);
    })

    // close modal avec touche Echap
    $(document).keyup(function(e) {
        if (e.key === "Escape") {
            $('.modal__disconnect').fadeOut(200);
        }
    });

    // close en cliquant en dehors du modal
    $(document).mouseup(function(e){
        let poppins = $(".modal__disconnect--content");
        if(!poppins.is(e.target) && poppins.has(e.target).length === 0){
            $(".modal__disconnect").hide();
        }else{
            $(".modal__disconnect").show();
        }
    });

    //changement de thème
    $('.switch__mode').on('click',function(){
        let clicks = $(this).data('clicks');
        let URL = "../../" + window.location.pathname.split('/')[1];
        let logoFooter = $('.tweet__logo--footer');
        let logoHeader = $('.tweetWac__logo');

        if (clicks){
            $("body").removeClass('dark');
            //change logo en mode light
            changeLogo('logo_tweetWac.png' , '100px');
        }else{
            $("body").addClass('dark');
            //change logo en mode dark
            changeLogo('darken-logo.png' , '150px');
        }
        $(this).data("clicks", !clicks);

        function changeLogo($src, $width){
            logoHeader.fadeOut(500);
            logoHeader.attr('src', URL + '/Public/assets/images/' + $src);
            logoHeader.fadeIn(1000);
            logoFooter.attr('src', URL + '/Public/assets/images/' + $src);
            logoFooter.css('maxWidth', $width);
        }
    })
});