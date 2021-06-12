$(document).ready(function () {

    let urlSource = $(location)[0].origin + '/Tweeter/';

    $("#abonnements").on("click", function(){
        deleteContent();
        getDataFollow();
    });

    $("#abonnes").on("click", function(){
        deleteContent();
        getDataFollow();
    });

    function deleteContent() {
        $(".contentFollower").remove();
        $(".contentFollowing").remove();
    }

    function getDataFollow() {

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

        let login = getParameter('f');

        $.ajax( {
            type: "GET",
            url: "../Private/viewFollow.php",
            data: {login: login},
            dataType: "json",

            success:function(data) {
                if (data["success"] === true) {

                    const followers = $("#followers");
                    const following = $("#following");

                    $(".user__name--bold").text(data["name"][0]["name"]);

                    for (let i = 0; i< data["follower"].length; i++) {

                        const div = addFollowers(data["follower"][i], i);
                        followers.append(`<div class='contentFollower a${i}'></div>`);
                        $(".a"+i).append(div);
                        let nbOcc = 0;
                        for (let j = 0; j < data["arrFollowedUser"].length; j++) {
                            if (data["arrFollowedUser"][j]["fk_id_followed"] === data['follower'][i].fk_id_follower) {
                                nbOcc++;
                            }
                        }

                        if(nbOcc > 0) {
                            $(".followers"+i).append(`<button class="btn btn__follow--on" data-target="`+ data['follower'][i].pseudo +`"></button>`);
                        } else {
                            $(".followers"+i).append(`<button class="btn btn__follow" data-target="`+ data['follower'][i].pseudo +`"></button>`);
                        }
                    }

                    for (let i = 0; i< data["followed"].length; i++) {

                        const div = addFollowed(data["followed"][i], i);
                        following.append(`<div class='contentFollowing b${i}' ></div>`);
                        $(".b"+i).append(div);

                        let nbOcc = 0;
                        for (let j = 0; j < data["arrFollowedUser"].length; j++) {

                            if (data["arrFollowedUser"][j]["fk_id_followed"] === data['followed'][i].fk_id_followed) {
                                nbOcc++;
                            }
                        }

                        if(nbOcc > 0) {
                            $(".followed"+i).append(`<button class="btn btn__follow--on" data-target="`+ data['followed'][i].pseudo +`"></button>`);
                        } else {
                            $(".followed"+i).append(`<button class="btn btn__follow" data-target="`+ data['followed'][i].pseudo +`"></button>`);
                        }
                    }

                    function addFollowers(data, nbrFollower) {
                        const html = `<div class="new__tweet item__border row">
                            <a href="${urlSource}Profil/?f=${data.pseudo}">
                                <img class="rounded-circle user_image--apercu"
                                     src="/Tweeter/Public/assets/images/default_profile_400x400.png"
                                     alt="photo profil user">
                            </a>

                            <div style="margin-left: 10px; width: 100%;">
                                <div class="d-flex followers${nbrFollower}" style="justify-content: space-between">
                                    <div class="d-flex">
                                        <div>
                                            <a href="${urlSource}Profil/?f=${data.pseudo}"
                                               class="user__name"> ${data.name} </a>
                                            <p class="user__pseudo">@${data.pseudo} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex" style="justify-content: space-between;">
                                    <p class="tweet_message mb-0"
                                       style="font-family: 'Segoe UI',serif;">${data.description}</p>
                                </div>
                            </div>
                        </div>`;
                        return html;
                    }

                    function addFollowed(data , nbrFollowed) {
                        const html1 = `<div class="new__tweet item__border row">
                                            <a href="${urlSource}Profil/?f=${data.pseudo}">
                                                <img class="rounded-circle user_image--apercu"
                                                     src="/Tweeter/Public/assets/images/default_profile_400x400.png"
                                                     alt="photo profil user">
                                            </a>
                                
                                            <div style="margin-left: 10px; width: 100%;">
                                                <div class="d-flex followed${nbrFollowed}" style="justify-content: space-between">
                                                    <div class="d-flex">
                                                        <div>
                                                            <a href="${urlSource}Profil/?f=${data.pseudo}" class="user__name">${data.name}</a>
                                                            <p class="user__pseudo ml-1">@${data.pseudo}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex" style="justify-content: space-between;">
                                                    <p class="tweet_message mb-0" style="font-family: 'Segoe UI',serif;">${data.description}</p>
                                                </div>
                                            </div>
                                        </div>`;
                        return html1;
                    }
                    // if a input needed are wrong or exist write error message
                } else if (data["success"] === false) {

                }
            },

            error: function (xhr, status, error) {
                console.log("errorjs");
                console.log(xhr);
                console.log("view abo echoué " + xhr.responseText );
                console.log(error);
            }
        });
    }
});