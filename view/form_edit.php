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
    
    if ($_SERVER["REQUEST_METHOD"] == 'GET'){
        
        // méthode GET récupérer l'id du lien à modifier afin de remplir les champs nom, description, ... du favori à modifier
        if (isset($_GET['id']))
        {
            $id_fav_selected = HtmlEntities(intVal($_GET['id'])) ;
            require("../model/connect.php") ;   
            
            $db = connection('localhost', 'favoris', 'root','');  

            if (isset($db)){ 

                // Affiche les informations du favori sélectionné
                require("../model/get.php");
                $data = get("favori",$db, $id_fav_selected);

                // renvoie une seule ligne 
                $nom=$data[0]["nom"];
                $etiquette=$data[0]["etiquette"];
                $description=$data[0]["descript"];
                $adresse=$data[0]["adresse_url"];
                $categorie_fav=$data[0]["categorie"];
                $ss_categorie_fav=$data[0]["ss_categorie"];
                $type_favori_fav=$data[0]["type_favori"];
                $id_cat=$data[0]["id_cat"];
                $id_ss_cat=$data[0]["id_ss_cat"];
                $id_type=$data[0]["id_type"];        
                
                
                // création de la liste des catgéories dans le select du form
                $list_categorie = get("categorie", $db); 
                
                // création de la liste des types de favori dans le select du form
                $list_type = get("type_favori", $db); 

                // création de la liste filtrées des ss catégorie, si une catégorie est sélectionnée
                if (isset($categorie_fav)) {
                    $list_ss_cat_filtered = get_join("categorie_ss_categorie", $db, $categorie_fav);
                }
                

            }
            else { echo "Pas de connexion à la base de données";}
        }

        else {header("location: /brief5/index.php");}
    }
    
    else {
        //Method POST pour l'update
            
        require ('../model/update.php');

        if (!function_exists('connection')) {  // ce test est déjà fait directement dans connect.php. L'idée est de montrer qu'on peut le faire de n'importe où
            require("../model/connect.php") ;             
            $db = connection('localhost', 'favoris', 'root','');  
        }

        // Appel de la fonction update
        $result = update("favori", $db);

        do {
            if(!$result[0])
            {
                $errorMessage = "La mise à jour n'a pas été réalisée.";
                echo '$errorMessage:'.$errorMessage;
                break;
            };

            $succesMessage = "Favori modifié";
            header("location: /brief5/index.php");
            exit;
        } 
        while (false);
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
    <link rel="stylesheet" type="text/css" href="../style/style.css">

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
                    <select name="categorie" id="form_id_cat" class="linked-select" data-target = "form_id_ss_cat" data-source = "../model/list_ss_cat.php?type=ss_categorie&filter=$id">
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
    <script src="../script/select_cascade.js"></script>
    
</body>
</html>