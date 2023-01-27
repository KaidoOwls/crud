<?php

// on importe le contenu du fichier "db.php"
include "db.php";
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();
// on lance une requête pour chercher toutes les fiches disc
$requete = $db->query("SELECT * FROM disc JOIN artist on artist.artist_id=disc.artist_id ");


// on récupère tous les résultats trouvés dans une variable
$tableau = $requete->fetchAll(PDO::FETCH_OBJ);
// on clôt la requête en BDD
$requete->closeCursor();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disc</title>
</head>
<body>
    <table>
        
        <?php foreach ($tableau as $disc): ?>
        <tr>
            <td> <img src="Img/<?= $disc->disc_picture ?>" width="100px" alt=""></td>
            <td>Artist : <?= $disc->artist_name ?></td>
            <td>Title : <?= $disc->disc_title ?></td>
            <td>Label : <?= $disc->disc_label ?></td>
            <td>Year : <?= $disc->disc_year ?></td>
            <td></td>
            <td>Genre : <?= $disc->disc_genre ?></td>


            <!-- Ici, on ajoute un lien par artiste pour accéder à sa fiche : -->
            <td><a href="disc_detail.php?id=<?= $disc->disc_id ?>">Détail</a></td>
        </tr>
        <?php endforeach; 
        ?> <button><a href="script_disc_ajout.php">Ajouter</a></button>
            
    </table>

</body>
</html>