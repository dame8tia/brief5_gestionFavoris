<?php
     function update(string $table, object $db) {
        $db = $db ;

        // préparation de la requête si connexion
        if (isset($db)){
             
            $data = null ;
            $query = "";
            $table = $table ;         

            // recherche du fichier émetteur
            $fileEmit = explode('/',$_SERVER["SCRIPT_FILENAME"]);
            $indTabFile = count($fileEmit)-1;
            $fileEmit = $fileEmit[$indTabFile];
            
            // Requête fct du fichier émetteur
            switch ($fileEmit)
            {   
                case "form_edit.php" :

                    // traitement particulier pour ces 3 variables qui sont injectées dans la req SQL comme les valeurs de clés étrangères
                    // traitement du cas de la valeur Null 
                    if($_POST["categorie"]=='0')
                    {
                        $_POST["categorie"]=Null;
                        $id_cat = $_POST["categorie"];
                    }
                    else {
                        $id_cat=HtmlEntities(intval($_POST["categorie"]));
                    };

                    if ($_POST["ss_categorie"]=='0')
                    {
                        $_POST["ss_categorie"]=Null;
                        $id_ss_cat = $_POST["ss_categorie"];
                    }
                    else {
                        $id_ss_cat =HtmlEntities(intval($_POST["ss_categorie"]));
                    };

                    if ($_POST["type_favori"]=='0')
                    {
                        $_POST["type_favori"]=Null;
                        $id_type_fav = $_POST["type_favori"];
                    }
                    else {
                        $id_type_fav =HtmlEntities(intval($_POST["type_favori"]));
                    };

                    // affectation des variables de la superglobale $POST
                    $nom            = HtmlEntities($_POST["nom"]);
                    $etiquette      = HtmlEntities($_POST["etiquette"]);
                    $description    = HtmlEntities($_POST["description"]);
                    $adresse        = HtmlEntities($_POST["adresse"]);
                    $id             = HtmlEntities(intval($_POST["id"]));

                    // requête
                    $query = '';
                    $query.= "UPDATE favori SET nom= :nom, etiquette= :etiquette, ";    
                    $query.= 'descript= :descript, adresse_url= :adresse,id_cat= :id_cat, ';
                    $query.= 'id_ss_cat= :id_ss_cat, id_type= :id_type ';
                    $query.= 'WHERE id= :id';

                    // Exécution de la requête
                    $query = $db->prepare($query);
                    $query->bindValue(':id', $id, PDO::PARAM_INT);
                    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
                    $query->bindValue(':etiquette', $etiquette, PDO::PARAM_STR);
                    $query->bindValue(':descript', $description, PDO::PARAM_STR);
                    $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
                    $query->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
                    $query->bindValue(':id_ss_cat', $id_ss_cat, PDO::PARAM_INT);
                    $query->bindValue(':id_type', $id_type_fav, PDO::PARAM_INT);
                    /* $resultat_exec = $query->execute(['nom' => $nom, 'etiquette'=>$etiquette, 'descript'=>$description
                                                    , 'adresse'=>$adresse, 'id_cat'=> $id_cat, 'id_ss_cat'=> $id_ss_cat, 'id_type'=>$id_type_fav]); */
                    break;
                    
                default:
                    echo "Fichier émetteur non reconnu ".$fileEmit ;
            } ;


            // Traitement de la requete
            $resultat_exec = $query->execute();

            $errorMessageQuery = "";   
            if (!$resultat_exec)
            {
                $errorMessageQuery = "Invalid Query ".$query->error ;
            };
    
            return array($resultat_exec, $errorMessageQuery) ;

        } else { echo "Pas de connexion à la base de données";}       

    };