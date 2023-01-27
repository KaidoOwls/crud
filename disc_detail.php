<?php
    // On se connecte à la BDD via notre fichier db.php :
    require "db.php";
    $db = connexionBase();

    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];

    // On crée une requête préparée avec condition de recherche :
    $requete = $db->prepare("SELECT * FROM disc JOIN artist on artist.artist_id=disc.artist_id  WHERE disc_id=?");
    // on ajoute l'ID du disque passé dans l'URL en paramètre et on exécute :
    $requete->execute(array($id));

    // on récupère le 1e (et seul) résultat :
    $mydisc = $requete->fetch(PDO::FETCH_OBJ);

    // on clôt la requête en BDD
    $requete->closeCursor();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDO - Détail</title>
    </head>
    <body>
        Title : <?=$mydisc->disc_title ?>
        Nom de l'artiste : <?= $mydisc->artist_name ?>
        Year : <?= $mydisc->disc_year ?>
        Genre : <?= $mydisc->disc_genre ?>
        Label : <?= $mydisc->disc_label ?>
        Price : <?= $mydisc->disc_price ?>
        Picture : <img src="Img/<?= $mydisc->disc_picture ?>" width="200px" alt="">
        <a href="disc_form.php?id=<?= $mydisc->disc_id ?>">Modifier</a>
        <a href="script_disc_delete.php?id=<?= $mydisc->disc_id ?>">Supprimer</a>
        <a href="disc.php">Retour</a>
    </body>
</html>