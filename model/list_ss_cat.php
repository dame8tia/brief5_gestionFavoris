<?php
    /* tutoriel suivi : Graphikart https://www.youtube.com/watch?v=8T4zOV8iHD0*/

    /* Permet de préparer et éxécuter les requêtes pour les listes déroulantes. 
    La seconde dépendant de la première
    Apparait dans un attribut spécifique data-source (HTML5) de l'élément HTML select.
    data-source = "script/list_ss_cat.php?type=ss_categorie&filter=$id" du select de la catégorie
    $id étant l'id de la catégorie */

    require("connect.php");
    $db = connection('localhost', 'favoris', 'root','');
    $list_dependante = empty($_GET['type']) ? "ss_categorie" : HtmlEntities($_GET['type']); /* équivalent à un if cf.cours OCR : condition ternaire*/
    
    if ($list_dependante === "ss_categorie"){
        
        $table = "categorie_ss_categorie";

        
        if(isset($_GET['filter'])){ // filter correspond à l'id de la catégorie qui va permettre de récupérer les sous catégories de la catégorie sélectionnée
            
            $id_cat = htmlEntities(intval($_GET['filter']));
            
            $query = "SELECT t2.id_ss_cat, t2.ss_categorie FROM categorie_ss_categorie AS t1 JOIN ss_categorie AS t2 ON t1.id_ss_cat = t2.id_ss_cat WHERE id_cat = :id";
            $query = $db->prepare($query);
            $query->execute(['id' => $id_cat]);
            $data = $query->fetchAll();
            /* require("get.php"); // L'appel de la fonction ne fonctionne pas
            $data = get($table, $db, $id_cat); */
          
            
            /* echo '<pre>' ; */            
            // création d'un tableau des résultats méthode array_map
            
            // format du json
            header('Content-Type:application/json');
            echo json_encode(
            /* var_dump( */
                array_map(function($ligne){
                    return [                        
                    'label' => $ligne['id_ss_cat'],
                    'value' => $ligne['ss_categorie']
                    ];
                }, $data)
            /* ); // fermeture du var_dump()*/
            );
            /* echo '<\pre>' ; */     
        }
        
    }
    else {throw new Exception("Type inconnu : ".HtmlEntities($_GET['type'])) ; }
