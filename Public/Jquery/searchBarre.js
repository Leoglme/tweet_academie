$(document).ready(function () {
    let urlSource = $(location)[0].origin + '/Tweeter/';

    $("#form2").keyup(function() {
        $('#menuDeroulantTweet').css('display', "none");
        $('#menuDeroulantUsers').css('display', "none");
    });
    /* Recherche sur la page search.php */
    $(".search__tweet").keyup(function() {
        $('#menuDeroulantTweet').html('');
        $('#menuDeroulantUsers').html('');
        $('#searchHashtag').html('');
        $('#searchUser').html('');
        let  values = $(this).val();
        localStorage.setItem("val", values);
        console.log(localStorage.getItem("val", values));
        let valuesLocal = localStorage.getItem("val");
        if (values !== "") {
            $.ajax({
                url: urlSource + 'Private/search.php',
                type: 'GET',
                dataType: 'json',
                data: "tweet=" + encodeURIComponent(values),
                success: function (data) {
                    if (data !== "" && data['tweets'].length >= 1) {
                        for (var i = 0; i < data['tweets'].length; i++) {
                            resultContent($('#searchHashtag'), data['tweets'][i].name, data['tweets'][i].pseudo, data['tweets'][i].tweet);
                            resultContent($('#menuDeroulantTweet'), data['tweets'][i].name, data['tweets'][i].pseudo, data['tweets'][i].tweet);
                        }
                    }

                    if (data !== "" && data['users'].length >= 1) {
                        for (var i = 0; i < data['users'].length; i++) {
                            resultUser($('#searchUser'), data['users'][i].name, data['users'][i].pseudo);
                            resultUser($('#menuDeroulantUsers'), data['users'][i].name, data['users'][i].pseudo);
                        }
                    }
                    if (data !== "" && data['users'].length < 1) {
                        $('#searchUser').html('Aucun utilisateur').css('text-align', 'center');
                        $('#menuDeroulantUsers').html('Aucun utilisateur');
                    }
                    if (data !== "" && data['tweets'].length < 1) {
                        $('#searchHashtag').html('Aucun Hashtag').css('text-align', 'center');
                        $('#menuDeroulantTweet').html('Aucun Hashtag');
                    }
                    $("#menuDeroulantTweet .new__tweet").on('click',function(){
                        location.href = "Search/";
                        // valuesLocal = (localStorage.getItem("val"));
                        // $("#form2").html(valuesLocal);
                    });
                    $("#menuDeroulantUsers .new__tweet").on('click',function(){
                        location.href = "Search/";
                        // valuesLocal = (localStorage.getItem("val"));
                        // $(".search__tweet").html(valuesLocal);
                    });
                }
            });
        }else{
            console.log("toto");
        }
        if (values === "quentin") {
            alert("... ca mérite pas un petit 23/20 ça ?!");
        }


        function resultContent($selector, $name, $pseudo, $content) {
            let profilLink = urlSource + "Profil";
            let imageLink = urlSource + "Public/assets/images/default_profile_400x400.png";


            $selector.append('<div class="new__tweet item__border row">\n' +
                '    <a href=' + profilLink + '>\n' +
                '        <img class="rounded-circle user_image--apercu"\n' +
                '             src=' + imageLink + '>\n' +
                '    </a>\n' +
                '    <div style="margin-left: 10px;">\n' +
                '        <div class="d-flex">\n' +
                '            <a href="/Profil" class="user__name">' + $name + '</a>\n' +
                '            <p class="user__pseudo ml-1">@' + $pseudo + '</p>\n' +
                '        </div>\n' +
                '        <p class="tweet_message">' + $content + '</p>\n' +
                '    </div>\n' +
                '</div>\n'
            );
        }


        function resultUser($selector, $name, $pseudo) {
            let profilLink = urlSource + "Profil";
            let imageLink = urlSource + "Public/assets/images/default_profile_400x400.png";

            $selector.append('<div class="new__tweet item__border row">\n' +
                '            <a href=' + profilLink + '>\n' +
                '                <img class="rounded-circle user_image--apercu"\n' +
                '                     src=' + imageLink + '>\n' +
                '            </a>\n' +
                '\n' +
                '            <div style="margin-left: 10px; width: 100%;">\n' +
                '                <div class="d-flex" style="justify-content: space-between">\n' +
                '                    <div class="d-flex">\n' +
                '                        <div>\n' +
                '                            <a href="<?= $filename ?>/Profil" class="user__name">' + $name + '</a>\n' +
                '                            <p class="user__pseudo ml-1">@' + $pseudo + '</p>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '\n' +
                '                    <button class="btn btn__follow"></button>\n' +
                '                </div>\n' +
                '                <div class="d-flex" style="justify-content: space-between;">\n' +
                '                    <p class="tweet_message mb-0" style="font-family: \'Segoe UI\',serif;">Ceci est une description\n' +
                '                        #test</p>\n' +
                '                </div>\n' +
                '\n' +
                '            </div>\n' +
                '        </div>');
        }
    });
})