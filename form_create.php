<?php
    $nom="";
    $etiquette="";
    $description="";
    $adresse="";
    $categorie="";
    $ss_categorie="";
    $type_favori="";

    $errorMessage ="";
    $succesMessage ="";

    $succes = false;
    $echec = ""; // message d'erreur à initialiser avec le second param renvoyé par la fonction add

    // traite les données poster suite à l'envoi du formulaire
    if ($_SERVER['REQUEST_METHOD']=='POST')
    {
        /*echo "<pre>";
        var_dump($_POST);
        echo "</pre>"; */

        $nom            =$_POST["nom"];
        $adresse        =$_POST["adresse"];

        do {
            if(empty($nom)|| empty($adresse))
            {
                $errorMessage = "Les champs nom et adresse sont obligatoires";
                break;
            }

            // ajouter le favori dans la table
            $query = "";
            $query = 
                'INSERT INTO favori (nom, etiquette, descript, adresse_url, id_cat, id_ss_cat, id_type)
                VALUES (:nom, :etiquette, :descript, :adresse, :id_cat, :id_ss_cat, :id_type)';
            
            // nouvelle connexion
            require_once("source/connect.php");
            $db = connection('localhost', 'favoris', 'root','');

            // requête INSERT 
            require("source/add.php");            
            $retrunFunctionAdd = add($query, $db); 
            /* var_dump($retrunFunctionAdd ); */

            $succes = $retrunFunctionAdd[0];
            $echec = $retrunFunctionAdd[1] ;

            if ($succes) {
                $succesMessage = "Favori ajouté";
            }

            if (!empty($echec)){
                $errorMessage = $echec;
            }

            // réinitialisation des variables
            $nom="";
            $adresse="";

           
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
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <!-- Appel du script pour les listes déroulantes en cascade catégorie/sous catégorie -->
    <!-- <script src="source/select_cascade.js"></script> A mettre en bas ou mettre DEFER--> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">

        <h2>Nouveau favori</h2>

        <?php 
        // affichage du message d'erreur si nécessaire après validation du formulaire
        if (!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class ='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <!-- --------------- Lancement des réquêtes pour la liste des catagéories, sous catégories et types de favoris -->
        <?php
        // Nouvelle connexion à la bdd
        require_once("source/connect.php");
        $db = connection('localhost', 'favoris', 'root','');

        // création de la liste des catgéories dans le select du form
        $query = "";
        $query.= "SELECT * FROM categorie;";
        require("source/get.php");
        $categories = get($query, $db);  

        // création de la requête sous catgéorie
        //---- >Faite au moment de la selection de la catégorie

        // création de la liste des types de favori dans le select du form
        $query = "";
        $query.= "SELECT * FROM type_favori";
        /* require("source/get.php"); déjà demandé pour les catégories*/
        $type_favoris = get($query, $db);  
        ?>


        <!-- --------------- Le formulaire d'Ajout -->
        <form method="post">
            <!-- OLD Champ alimenté par une fonction js pour connaitre l'id de la catégorie et pouvoir ainsi filtrer les sous catégorie -->
            <!-- <input type="hidden" id="id_cat_selected"> --><!-- Mis à jour avec JS -->            
            
            <!-- Finalement traitement en JS (script js en bas) AJAX avec XMLHttpRequest pour connaitre la catégorie sélectionnée pour filtrer correctement les sous catégories -->
            
            <!-- Les éléments de mon formulaire pour créer un favori -->
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
                        // On affiche chaque catégorie une à une
                        foreach ($type_favoris as $type_favori) { 
                        ?>
                        <option value=" <?= $type_favori['id_type']?>">
                                <?= $type_favori['type_favori']?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Categorie</label>
                <div class="col-sm-6">
                    <select name="categorie" id="form_id_cat" class="linked-select" data-target="form_id_ss_cat" data-source = "source/list_ss_cat.php?type=ss_categorie&filter=$id">
                        <option value=0>Sélectionner une catégorie</option>
                        <?php
                        // On affiche chaque catégorie une à une dans la liste déroulante (option)
                        foreach ($categories as $categorie) {
                        echo "<option value=\"".$categorie['id_cat']."\"";
                        /* if ($categorie['']==$){
                            echo " selected";
                        } */
                        echo ">".$categorie['categorie']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Sous catgéorie</label>
                <div class="col-sm-6">
                    <select name="ss_categorie" id="form_id_ss_cat" style = "display:none">  <!-- class="linked-select" -->
                        <option value=0>Sélectionner une sous catégorie</option>
                    </select>
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
                    <button type="submit" class="btn btn-primary" name="valider">Valider</button>
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