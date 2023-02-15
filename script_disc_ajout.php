<?php
    // Récupération du title$title :
    if (isset($_POST['title']) && $_POST['title'] != "") {
        $title = $_POST['title'];
    }
    else {
        $title = Null;
    }

    // Récupération du price (même traitement, avec une syntaxe abrégée)
    $price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;

    // Récupération du year (même traitement, avec une syntaxe abrégée)
    $year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;

    // Récupération du Label (même traitement, avec une syntaxe abrégée)
    $label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;

    // Récupération du Genre (même traitement, avec une syntaxe abrégée)
    $genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;

    // Récupération du Artist (même traitement, avec une syntaxe abrégée)
    $artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;

     // Récupération du picture (même traitement, avec une syntaxe abrégée)
     $picture = (isset($_POST['picture']) && $_POST['picture'] != "") ? $_POST['picture'] : Null;


    // En cas d'erreur, on renvoie vers le formulaire
    if ($title == Null || $price == Null || $year == Null|| $label == Null || $genre == Null || $artist == Null || $picture == Null) {
        header("Location: disc_new.php");
        exit;
    }

 // S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
    require "db.php"; 
    $db = connexionBase();
   
    try {
        // Construction de la requête INSERT sans injection SQL :
        $requete = $db->prepare("INSERT INTO disc (disc_title, disc_price,disc_year, disc_label, disc_genre, artist_id, disc_picture) VALUES (:title, :price, :year, :label, :genre, :artist, :picture);");
     
        // Association des valeurs aux paramètres via bindValue() :
        $requete->bindValue(":price", $price, PDO::PARAM_STR);
        $requete->bindValue(":title", $title, PDO::PARAM_STR);
        $requete->bindValue(":year", $year, PDO::PARAM_STR);
        $requete->bindValue(":label", $label, PDO::PARAM_STR);
        $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
        $requete->bindValue(":artist", $artist, PDO::PARAM_STR);
        $requete->bindValue(":picture", $picture, PDO::PARAM_STR);



        // Lancement de la requête :
        $requete->execute();
    
        // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
        $requete->closeCursor();
    }
    
    // Gestion des erreurs
    catch (Exception $e) {
        var_dump($requete->queryString);
        var_dump($requete->errorInfo());
        echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
        die("Fin du script (script_disc_ajout.php)");
    }
    
    // Si OK: redirection vers la page artists.php
    header("Location: disc.php");
    
    // Fermeture du script
    exit;
 