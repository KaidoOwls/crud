<?php
// // On charge l'enregistrement correspondant à l'ID passé en paramètre :
    require "db.php";
    $db = connexionBase();
    $requete = $db->prepare("SELECT * FROM disc JOIN artist on artist.artist_id=disc.artist_id  WHERE disc_id=?");    $requete->execute(array($_GET["id"]));
    $myArtist = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout</title>
</head>
<body>

    <h1>Artiste n°<?= $myArtist->artist_id; ?></h1>

    <a href="disc.php">Retour à la liste des disc</a>

    <br>
    <br>
    
</body>
</html>