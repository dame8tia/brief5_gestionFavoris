<?php
    $nom="";
    $etiquette="";
    $description="";
    $adresse="";
    $categorie_fav="";
    $ss_categorie_fav="";
    $id_cat="";
    $id_ss_cat="";
    $type_favori_fav="";
    $id_type="";

    $errorMessage ="";
    $succesMessage ="";

    
    if ($_SERVER["REQUEST_METHOD"]== 'GET'){
        // méthode GET pour que les champs soient renseignés
        if (isset($_GET['id']))
        {
            $id_fav_selected = $_GET['id'] ;
            require("script/connect.php") ;   
            
            $db = connection('localhost', 'favoris', 'root','');  

            if (isset($db)){
                
                // affiche le favori à mettre à jour
                $selectedFavori = 
                'SELECT t1.id, t1.nom, t1.etiquette, t1.descript
                , t1.adresse_url, t2.id_cat, t2.categorie, t3.id_ss_cat, t3.ss_categorie, t4.id_type, t4.type_favori
                FROM favori AS t1
                LEFT OUTER JOIN categorie AS t2
                ON t1.id_cat = t2.id_cat
                LEFT OUTER JOIN ss_categorie AS t3
                ON t1.id_ss_cat = t3.id_ss_cat 
                LEFT OUTER JOIN type_favori AS t4
                ON t1.id_type = t4.id_type 
                WHERE t1.id ='.$id_fav_selected.';'  ;

                require("script/get.php");
                $selectedFavori = get($selectedFavori, $db);

                // renvoie une seule ligne 
                $nom=$selectedFavori[0]["nom"];
                $etiquette=$selectedFavori[0]["etiquette"];
                $description=$selectedFavori[0]["descript"];
                $adresse=$selectedFavori[0]["adresse_url"];
                $categorie_fav=$selectedFavori[0]["categorie"];
                $ss_categorie_fav=$selectedFavori[0]["ss_categorie"];
                $type_favori_fav=$selectedFavori[0]["type_favori"];
                $id_cat=$selectedFavori[0]["id_cat"];
                $id_ss_cat=$selectedFavori[0]["id_ss_cat"];
                $id_type=$selectedFavori[0]["id_type"];           

            }
            else { echo "Pas de connexion à la base de données";}
        }

        else {header("location: /brief5/index.php");}
    }
    else {
    //Method POST pour l'update
        require ('script/update.php');
        $query='';
        $query.= "UPDATE favori SET nom= :nom, etiquette= :etiquette, ";    
        $query.= 'descript= :descript, adresse_url= :adresse,id_cat= :id_cat, ';
        $query.= 'id_ss_cat= :id_ss_cat, id_type= :id_type ';
        $query.= 'WHERE id= :id';

        if (!function_exists('connection')) {
            require("script/connect.php") ;             
            $db = connection('localhost', 'favoris', 'root','');  
        }

        $result = update($query, $db);

/*         echo 'retourExec :'.$result[0].'\n';
        echo 'is_bool(retourExec) :'.is_bool($result[0]); */

        do {
            if(!$result[0])
            {
                $errorMessage = "La mise à jour n'a pas été réalisée.";
                echo '$succesMessage:'.$succesMessage;
                break;
            };

            $succesMessage = "Favori modifié";
            header("location: /brief5/index.php");
            exit;
        } 
        while (false);
        /* echo '$succesMessage:'.$succesMessage; */

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des favoris</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Favori à modifier</h2>

        <?php 
        // affichage du message d'erreur si nécessaire
        if (!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class ='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <?php
            if (!function_exists('connection')) {
                require("script/connect.php") ;             
                $db = connection('localhost', 'favoris', 'root','');  
            }

            // création de la liste des catgéories dans le select du form
            $query = "";
            $query.= "SELECT * FROM categorie;";
            if (!function_exists('get')) {
                require("script/get.php");
            }
            $list_categorie = get($query, $db); 
            
            // création de la liste des types de favori dans le select du form
            $query = "";
            $query.= "SELECT * FROM type_favori";
            if (!function_exists('get')) {
                require("script/get.php");
            }
            $list_type = get($query, $db); 

            // création de la liste des ss catégorie
            $query = "";
            $query.= "SELECT t2.id_ss_cat, t2.ss_categorie 
                    FROM categorie_ss_categorie AS t1 
                    JOIN ss_categorie AS t2 ON t1.id_ss_cat = t2.id_ss_cat
                    JOIN categorie AS t3 ON t3.id_cat = t1.id_cat
                    WHERE t3.categorie = \"$categorie_fav\"";
            /* require("script/get.php"); déjà demandé pour les catégories*/
            $list_ss_cat_filtered = get($query, $db);  ;
    
        ?>

        

        <form method="post">

            <!-- Traitement en AJAX pour connaitre la catégorie sélectionnée pour filtrer correctement les sous catégories -->
            <input type="hidden" name="id" value ="<?= $id_fav_selected;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?= $nom;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?= $description;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Etiquette</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="etiquette" value="<?= $etiquette;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Adresse</label>
                <div class="col-sm-6">
                    <input type="url" class="form-control" name="adresse" value="<?= $adresse;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nature du favori</label>
                <div class="col-sm-6">
                    <select name="type_favori">
                        <option value=0>Sélectionner un type</option>
                        <?php
                        // On affiche chaque catégorie une à une dans la liste déroulante (option)
                        foreach ($list_type as $ligne) {
                        echo '<option value="'.$ligne["id_type"].'"';
                        if ($ligne["type_favori"]==$type_favori_fav){
                            echo " selected";
                        }
                        echo ">".$ligne["type_favori"]."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Categorie</label>
                <div class="col-sm-6">
                    <select name="categorie" id="form_id_cat" class="linked-select" data-target="form_id_ss_cat" data-source = "script/list_ss_cat.php?type=ss_categorie&filter=$id">
                        <option value=0>Sélectionner une catégorie</option>
                        <?php
                        // On affiche chaque catégorie une à une dans la liste déroulante (option)
                        foreach ($list_categorie as $ligne) {
                        echo '<option value="'.$ligne["id_cat"].'"';
                        if ($ligne["categorie"]==$categorie_fav){
                            echo " selected";
                        }
                        echo ">".$ligne["categorie"]."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Sous catgéorie</label>
                <div class="col-sm-6">
                    <select name="ss_categorie" id="form_id_ss_cat">  <!-- class="linked-select" -->
                    <option value=0>Sélectionner une sous catégorie</option>
                    <?php
                        // On affiche chaque catégorie une à une dans la liste déroulante (option)
                        foreach ($list_ss_cat_filtered as $ligne) {
                        echo '<option value="'.$ligne["id_ss_cat"].'"';
                        if ($ligne["ss_categorie"]==$ss_categorie_fav){
                            echo " selected";
                        }
                        echo ">".$ligne["ss_categorie"]."</option>";
                        }
                        ?>

                    </select>
                </div>
            </div>
                </div>
            </div>

            <?php 
            if (!empty($succesMessage)){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$succesMessage</strong>
                            <button type='button' class ='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/brief5/index.php" role="button">Annuler</a>
                </div>
            </div>

        </form>

    </div>
    <script src="script_js/select_cascade.js"></script>
    
</body>
</html>