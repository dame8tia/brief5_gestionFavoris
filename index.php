<?php
    // Charge le fichier connect.php. Puis Lance la fonction connection
    require("model/connect.php") ;   
    $db = connection('localhost', 'favoris', 'root','');     
    
    // charge le script get.php et lance la fonction get(arg1, arg2)
    require("model/get.php");
    $data = get("favori",$db);
    
    require ('view/homepage.php');

// retirer la balise de fin php, s'il n'y a que du php.
