<?php
     function add(string $table, object $db) :array {
        $db = $db ;

        // préparation de la requête si connexion
        if (isset($db)){
            /**
             * ce fichier (get.php) peut être appelé depuis plusieurs fichiers. Je récupère donc le fichier emetteur pour connaitre 
             * la requête à passer
             */
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
                case "index.php" :

                    // Non concerné (pour l'instant)
                    break;
                    
    
                case "form_create.php" :
                    switch($table){
                        case "favori" :
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
                                $id_type_fav = intval($_POST["type_favori"]);
                            };

                            // affectation des variables de la superglobale $POST
                            $nom            = $_POST["nom"];
                            $etiquette      = $_POST["etiquette"];
                            $description    = $_POST["description"];
                            $adresse        = $_POST["adresse"];

                            // Exécution de la requête
                            $query = '  INSERT INTO favori (nom, etiquette, descript, adresse_url, id_cat, id_ss_cat, id_type)
                                        VALUES (:nom, :etiquette, :descript, :adresse, :id_cat, :id_ss_cat, :id_type)';
                            $query = $db->prepare($query);
                            $query->bindValue('nom', $nom, PDO::PARAM_STR);
                            $query->bindValue('etiquette', $etiquette, PDO::PARAM_STR);
                            $query->bindValue('descript', $description, PDO::PARAM_STR);
                            $query->bindValue('adresse', $adresse, PDO::PARAM_STR);
                            $query->bindValue('id_cat', $id_cat, PDO::PARAM_INT);
                            $query->bindValue('id_ss_cat', $id_ss_cat, PDO::PARAM_INT);
                            $query->bindValue('id_type', $id_type_fav, PDO::PARAM_INT);
                    
                            break;

                        case "categorie" :
                            echo "Ajout nouvelle catégorie à faire";
                            break;
                            
                        default:  echo "Nom de la table ne match avec aucun cas connu - appel depuis form_edit.php";
                    }
                    break;
                default:
                    echo "Fichier émetteur non reconnu ".$fileEmit ;
            } ;


            // Traitement de la requete
            $resultat_exec = $query->execute();// sur un INSERT INTO pas de fetchAll puisqu'aucune ligne n'est renseignée

            $errorMessageQuery = "";   
            if (!$resultat_exec)
            {
                $errorMessageQuery = "Invalid Query ".$query->error ;
            };
    
            return array($resultat_exec, $errorMessageQuery) ;

        } else { echo "Pas de connexion à la base de données";}  

    };

