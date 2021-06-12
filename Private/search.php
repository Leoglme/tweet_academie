
<?php
    $bdd = new PDO('mysql:host=localhost;dbname=common-database', 'anthony', 'toto');
    $result = [];
    $tweet_nom = $_GET['tweet'];
    $tweet = $bdd->query("SELECT DISTINCT * FROM tweet
            INNER JOIN users ON tweet.fk_id_user = users.id_user
            INNER JOIN hashtag ON hashtag.fk_id_tweet = tweet.id_tweet WHERE hashtag.nom = '$tweet_nom' ORDER BY id_tweet DESC LIMIT 50");
    $result['tweets'] = $tweet->fetchAll();
    $tweetNamePseudo = $bdd->query("SELECT DISTINCT pseudo, name FROM users WHERE pseudo = '$tweet_nom' OR name = '$tweet_nom' ORDER BY pseudo DESC LIMIT 50");
    $result['users'] = $tweetNamePseudo->fetchAll();

    echo json_encode($result);