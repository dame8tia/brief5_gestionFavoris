<?php
    // Charge le fichier connect.php. Puis Lance la fonction connection
    require("source/connect.php") ;   
    $db = connection('localhost', 'favoris', 'root','');     
    
    // Renvoie la liste des favoris
    if (isset($db)){
        // affiche les favoris : LEFT OUTER JOIN pour les favoris sans catégories
        $selectBookmarks = 
        'SELECT t1.id, t1.nom, t1.etiquette, t1.descript, t1.adresse_url, t2.categorie, t3.ss_categorie, t4.type_favori
        FROM favori AS t1
        LEFT OUTER JOIN categorie AS t2
        ON t1.id_cat = t2.id_cat
        LEFT OUTER JOIN ss_categorie AS t3
        ON t1.id_ss_cat = t3.id_ss_cat 
        LEFT OUTER JOIN type_favori AS t4
        ON t1.id_type = t4.id_type ;
        ORDER BY t1.id DESC';

        // charge le script
        require("source/get.php");
        // Lance la fonction get qui attend 2 param : la requête et la connexion, le résultat de la requête est récupéré pour l'affichage
        $bookmarks = get($selectBookmarks, $db);            
    }
    else { echo "Pas de connexion à la base de données";}
    
    require ('templates/homepage.php');

// retire la balise de fin php, s'il n'y a que du php.
