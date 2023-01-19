<?php
    

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
        
        ?>

        <?php
            if (!function_exists('connection')) {
                require("source/connect.php") ;             
                $db = connection('localhost', 'favoris', 'root','');  
            }

            // création de la liste des catgéories dans le select du form
            $query = "";
            $query.= "SELECT * FROM categorie;";
            if (!function_exists('get')) {
                require("source/get.php");
            }
            $list_categorie = get($query, $db); 
            
            // création de la liste des types de favori dans le select du form
            $query = "";
            $query.= "SELECT * FROM type_favori";
            if (!function_exists('get')) {
                require("source/get.php");
            }
            $list_type = get($query, $db); 

            // création de la liste des ss catégorie
            $query = "";
            $query.= "SELECT t2.id_ss_cat, t2.ss_categorie 
                    FROM categorie_ss_categorie AS t1 
                    JOIN ss_categorie AS t2 ON t1.id_ss_cat = t2.id_ss_cat
                    JOIN categorie AS t3 ON t3.id_cat = t1.id_cat
                    WHERE t3.categorie = \"$categorie_fav\"";
            /* require("source/get.php"); déjà demandé pour les catégories*/
            $list_ss_cat_filtered = get($query, $db);  ;
    
        ?>

        <form method="post">

            <!-- Traitement en AJAX pour connaitre la catégorie sélectionnée pour filtrer correctement les sous catégories -->
            <input type="hidden" name="id" value ="<?= $id_fav_selected;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?= $nom;?>" required>
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
                    <input type="url" class="form-control" name="adresse" value="<?= $adresse;?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Categorie</label>
                <div class="col-sm-6">
                    <select name="categorie" id="form_id_cat">
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

    

            <?php 
            // Message de succès
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
    
</body>
</html>