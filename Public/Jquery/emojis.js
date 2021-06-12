$(document).ready(function(){
    $(".emoji").click(function(){
        // valeur emojis dans le text area
        let cible = $("#newTweetHome");
        if ($(this)[0].offsetParent.className === "dropdown-menu emojiPickerModal"){
            cible = $("#newTweet");
        }
        cible.val(cible.val() + $(this).text());
    })
    //empêche 2 dropdown emojis ouvert en même temp
    $(".smile2").click(function(){
        $(".emojiPicker").fadeOut(200);
    })
})




