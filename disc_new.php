<?php
    // On se connecte à la BDD via notre fichier db.php :
    require "db.php";
    $db = connexionBase();

   
    // On crée une requête préparée avec condition de recherche :
    $requete = $db->query("SELECT * FROM disc JOIN artist on artist.artist_id=disc.artist_id");
  

    // on récupère le 1e (et seul) résultat :
    $mydisc = $requete->fetchAll(PDO::FETCH_OBJ);

    // on clôt la requête en BDD
    $requete->closeCursor();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO - Ajout</title>
</head>
<body>

    <h1>Saisie d'un nouveau disque</h1>

    <a href="disc.php"><button>Retour à la liste des disc</button></a>

    <br>
    <br>

    <form action ="script_disc_ajout.php" method="post">

        <label for="disc_du_label">Nom du disc :</label><br>
        <input type="text" name="title" id="disc_du_label">
        <br><br>

        <label for="Price_du_disc">Price :</label><br>
        <input type="text" name="price" id="Price_du_disc">
        <br><br>
        
        <label for="disc_year"> Year :</label><br>
        <input type="text" name="year" id="disc_year">
        <br><br>

        <label for="label">Label :</label><br>
        <input type="text" name="label" id="label">
        <br><br>

        <label for="genre">Genre :</label><br>
        <input type="text" name="genre" id="Genre">
        <br><br>

        <label for="artist">Artiste</label><br>
        <select name="artist" id="artist">
        <option disabled selected>Selection un artiste</option>
        <?php foreach ($mydisc as $artist):?>
            <option value="<?=$artist->artist_id?>"><?=$artist->artist_name?></option>
            <?php endforeach; ?>

        </select>


        <input type="submit" value="Ajouter">

    </form>
</body>
</html>
