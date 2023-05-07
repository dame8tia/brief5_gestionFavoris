<?php

    function get(string $table, pdo $db, int $identificateur=null):array {

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
            $identificateur = $identificateur; // pour la condition WHERE, s'il y a lieu

            if (isset($identificateur)){
                $withIdentif = true ;
            }           

            // recherche du fichier émetteur
            $fileEmit = explode('/',$_SERVER["SCRIPT_FILENAME"]);
            $indTabFile = count($fileEmit)-1;
            $fileEmit = $fileEmit[$indTabFile];
            
            // Requête fct du fichier émetteur
            switch ($fileEmit)
            {   
                case "index.php" :
                    switch($table){
                        case "favori" :
                            // affiche les favoris : LEFT OUTER JOIN pour les favoris sans catégorie
                            $query = 
                            'SELECT t1.id, t1.nom, t1.etiquette, t1.descript, t1.adresse_url, t2.categorie, t3.ss_categorie, t4.type_favori
                            FROM favori AS t1
                            LEFT OUTER JOIN categorie AS t2
                            ON t1.id_cat = t2.id_cat
                            LEFT OUTER JOIN ss_categorie AS t3
                            ON t1.id_ss_cat = t3.id_ss_cat 
                            LEFT OUTER JOIN type_favori AS t4
                            ON t1.id_type = t4.id_type ;
                            ORDER BY t1.id DESC';
                            break;
                        default :
                            echo "Nom de la table ne match avec aucun cas connu - appel depuis index.php";
                    }
                    break;
                case "form_edit.php" || "form_create.php" :
                    switch($table){
                        case "favori" :
                            switch ($withIdentif){
                                case False :
                                    break ;
                                case True :
                                    // affiche le favori à mettre à jour
                                    $query = 
                                    'SELECT t1.id, t1.nom, t1.etiquette, t1.descript
                                    , t1.adresse_url, t2.id_cat, t2.categorie, t3.id_ss_cat, t3.ss_categorie, t4.id_type, t4.type_favori
                                    FROM favori AS t1
                                    LEFT OUTER JOIN categorie AS t2
                                    ON t1.id_cat = t2.id_cat
                                    LEFT OUTER JOIN ss_categorie AS t3
                                    ON t1.id_ss_cat = t3.id_ss_cat 
                                    LEFT OUTER JOIN type_favori AS t4
                                    ON t1.id_type = t4.id_type
                                    WHERE t1.id ='.$identificateur.';'  ;                                    
                                    break;
                                default :
                                    echo "WithIdentificateur n'est pas un booleen";
                                    break ;                                
                            }
                            break;
                        
                        case "categorie_ss_categorie" :
                            switch ($withIdentif){                                
                                case False :
                                    $query = "SELECT * FROM categorie_ss_categorie ;";
                                    break ;
                                case True : // cas depuis le fichier list_ss_cat.php - L'appel de la fct depuis ce fichier .php ne fonctionne pas. En effet, ce script émane d'une fonction JS peut être est-ce çà ???
                                    $query = "SELECT t2.id_ss_cat, t2.ss_categorie 
                                            FROM categorie_ss_categorie AS t1 
                                            JOIN ss_categorie AS t2 
                                            ON t1.id_ss_cat = t2.id_ss_cat 
                                            WHERE id_cat = ".$identificateur.";" ;
                                    break;

                                default :
                                    echo "TABLE CATEGORIE : identificateur non reconnu comme un bool";
                                    break ; 
                            }
                            break ;  
                        default:  
                            $query =  "SELECT * FROM ".$table.";";
                            break;
                    }
                    break;
                default:
                    echo "Fichier émetteur non reconnu ".$fileEmit ;
            } ;

            // Traitement de la requete
            if (isset($query)){
                $query = $db->prepare($query);
                $query->execute();
                $data = $query->fetchAll();
            }
            else { echo "Requête vide"; }

            return $data;

        } else { echo "Pas de connexion à la base de données";}  
    };

    
    // SELECT AVEC JOINTURE : à affiner plus tard
    function get_join(string $table,pdo $db, string $identificateur=null):array {
        $db =$db ;
        // préparation de la requête si connexion
        if (isset($db)){
            /**
             * ce fichier (get.php) peut être appelé depuis plusieurs fichiers. Je récupère donc le fichier emetteur pour connaitre 
             * la requête à passer
             */
            $data = null ;
            $query = "";
            $table = $table ;
            $identificateur = $identificateur;

            if (isset($identificateur)){
                $withIdentif = true ;
            }           

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
                    
    
                case "form_edit.php" :
                    switch($table){
                        case "categorie_ss_categorie" :
                            switch ($withIdentif){
                                case False :
                                    break ;
                                case True :
                                    // affiche les sous catégories en fct de la catégorie sélectionnée 
                                    $query = "SELECT t2.id_ss_cat, t2.ss_categorie 
                                    FROM categorie_ss_categorie AS t1 
                                    JOIN ss_categorie AS t2 ON t1.id_ss_cat = t2.id_ss_cat
                                    JOIN categorie AS t3 ON t3.id_cat = t1.id_cat
                                    WHERE t3.categorie =\"".$identificateur."\";";
                                    ;                                    
                                    break;
                                default :
                                    echo "WithIdentificateur n'est pas un booleen";
                                    break ;                                
                            }
                            break;
                        default:  echo "Nom de la table ne match avec aucun cas connu - appel depuis form_edit.php";
                    }
                    break;
                default:
                    echo "Fichier émetteur non reconnu ".$fileEmit ;
            } ;


            // Traitement de la requete
            $query = $db->prepare($query);
            $query->execute();
            $data = $query->fetchAll();
            
            return $data;

        } else { echo "Pas de connexion à la base de données";}  
        

    };


