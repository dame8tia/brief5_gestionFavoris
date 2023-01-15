<?php
    /* $doc = new DomDocument;
    $id_cat_selected = $doc->getElementById('id_cat_selected');
    echo(" id_cat_selected : ".$id_cat_selected) ; */

    require("connect.php");
    $db = connection('localhost', 'favoris', 'root','');

    $list_dependante = empty($_GET['type']) ? "ss_categorie" : $_GET['type']; /* équivalent à un if cf.cours OCR*/
    
    if ($list_dependante === "ss_categorie"){
        $table = "categorie_ss_categorie";
        if(isset($_GET['filter'])){ // filter correspond à l'id de la catégorie qui va permettre de récupérer les sous catégories de la catégorie sélectionnée
            
            $id_cat = $_GET['filter'];
            
            $query = "SELECT t2.id_ss_cat, t2.ss_categorie FROM categorie_ss_categorie AS t1 JOIN ss_categorie AS t2 ON t1.id_ss_cat = t2.id_ss_cat WHERE id_cat = :id";
            $query = $db->prepare($query);
            $query->execute(['id' => $id_cat]);
            $ss_cats_filtered = $query->fetchAll();

/*             print_r($ss_cats_filtered); 
            echo '<pre>' ;
            print_r($ss_cats_filtered);
            echo '</pre>' ; */

            
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
                }, $ss_cats_filtered)
            /* ); // fermeture du var_dump()*/
            );
            /* echo '<\pre>' ; */            

        }
        
    }
    else {throw new Exception("Type inconnu : ".$_GET['type']) ; }




?>