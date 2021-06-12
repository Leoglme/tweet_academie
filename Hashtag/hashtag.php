<?php
    $bdd = new PDO('mysql:host=localhost;dbname=common-database', 'anthony', 'toto');
    $tweet = $_GET['q'];
//    $mention = $bdd->query("SELECT tweet FROM tweet WHERE tweet LIKE '%#$tweet%'");
    $mention = $bdd->query("SELECT * FROM tweet INNER JOIN users ON tweet.fk_id_user = users.id_user WHERE tweet LIKE '%#$tweet%'");
    $result = $mention->fetchAll();

foreach ($result as $values){
    echo $values['name']." : ".$values['tweet']." ( ".$values['pseudo']." ) " . '</br>';
}
