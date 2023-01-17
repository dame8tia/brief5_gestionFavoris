<?php
     function add(string $query, object $db) {
        $db = $db ;

        // traitement particulier pour ces 3 variables qui sont injectées dans la req SQL comme les valeurs de clés étrangères
        // traitement du cas de la valeur Null 
        if($_POST["categorie"]=='0')
        {
            $_POST["categorie"]=Null;
            $id_cat = $_POST["categorie"];
        }
        else {
            $id_cat=intval($_POST["categorie"]);
        };

        if ($_POST["ss_categorie"]=='0')
        {
            $_POST["ss_categorie"]=Null;
            $id_ss_cat = $_POST["ss_categorie"];
        }
        else {
            $id_ss_cat =intval($_POST["ss_categorie"]);
        };

        if ($_POST["type_favori"]=='0')
        {
            $_POST["type_favori"]=Null;
            $id_type_fav = $_POST["type_favori"];
        }
        else {
            $id_type_fav =intval($_POST["type_favori"]);
        };

        // affectation des variables de la superglobale $POST
        $nom            =$_POST["nom"];
        $etiquette      =$_POST["etiquette"];
        $description    =$_POST["description"];
        $adresse        =$_POST["adresse"];

        // Exécution de la requête
        $query = $db->prepare($query);
        $query->bindValue('nom', $nom, PDO::PARAM_STR);
        $query->bindValue('etiquette', $etiquette, PDO::PARAM_STR);
        $query->bindValue('descript', $description, PDO::PARAM_STR);
        $query->bindValue('adresse', $adresse, PDO::PARAM_STR);
        $query->bindValue('id_cat', $id_cat, PDO::PARAM_INT);
        $query->bindValue('id_ss_cat', $id_ss_cat, PDO::PARAM_INT);
        $query->bindValue('id_type', $id_type_fav, PDO::PARAM_INT);
        /* $resultat_exec = $query->execute(['nom' => $nom, 'etiquette'=>$etiquette, 'descript'=>$description
                                        , 'adresse'=>$adresse, 'id_cat'=> $id_cat, 'id_ss_cat'=> $id_ss_cat, 'id_type'=>$id_type_fav]); */
        
        $resultat_exec = $query->execute();

        $errorMessageQuery = "";   
        if (!$resultat_exec)
        {
            $errorMessageQuery = "Invalid Query ".$query->error ;
        };

        return array($resultat_exec, $errorMessageQuery) ;
    }
