$(document).ready(function(){
   let urlSource = $(location)[0].origin + '/Tweeter/';
   let currentFile = $(location)[0].pathname.match(/\/(\w+)\/$/)[1];
   if (currentFile === 'Tweeter'){
      currentFile = 'index.php';
   }

   getHashtags();
   function updateTweets(){
      let url_string = window.location.href
      let url = new URL(url_string);
      let userParam = url.searchParams.get("f");

      $.ajax({
         url: urlSource + 'Private/update-tweet.php',
         type: 'GET',
         dataType: 'html',
         data: 'refreshTweet=' + currentFile + '&f=' + userParam,

         success: function (code_html, status) {
            $('#toto').children().remove();
            $(code_html).prependTo("#toto");
            getHashtags();
         },
         complete:  function(){
            setTimeout(updateTweets, 10000);
         }
      });
   }
   setTimeout(updateTweets, 10000);
   /*Get # et @ dans un tweet et ajoute span + couleur*/
   function getHashtags(){
      $('.tweet_message').html(function(){
         return $(this).text().replace(/(#(\w+))/g, "<a class='new__hashtag' href= '"+ urlSource +"Hashtag/?q=$2'>$1</a>").replace(/(@(\w+))/g, "<a class='new__mentions' href= '"+ urlSource +"Profil/?f=$2'>$1</a>");
      });
   }
});