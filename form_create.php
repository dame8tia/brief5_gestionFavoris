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

    if ($_SERVER['REQUEST_METHOD']=='POST')
    {

        $nom            =$_POST["nom"];
        $adresse        =$_POST["adresse"];

        echo $_POST['valider'];

        do {
            if(empty($nom)|| empty($adresse))
            {
                $errorMessage = "Les champs nom et adresse sont obligatoires";
                break;
            }

            // ajouter le favori dans la base
            $query = "";
            $query = 
                'INSERT INTO favori (nom, etiquette, descript, adresse_url, id_cat, id_ss_cat, id_type)
                VALUES (:nom, :etiquette, :descript, :adresse, :id_cat, :id_ss_cat, :id_type)';
            
            // nouvelle connexion
            require_once("script/connect.php");
            $db = connection('localhost', 'favoris', 'root','');
            // requête INSERT 
            require("script/add.php");
            add($query, $db);            

            $nom="";
            $adresse="";

            $succesMessage = "Favori ajouté";
            header("location: /brief5/index.php");
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

    <script src="script/select_cascade.js"></script>

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

        <!-- Lancement des réquêtes pour la liste des catagéories, sous catégories et types de favoris -->
        <?php
        // Nouvelle connexion à la bdd
        require_once("script/connect.php");
        $db = connection('localhost', 'favoris', 'root','');

        // création de la requête catgéorie
        $query = "";
        $query.= "SELECT * FROM categorie;";
        require("script/get.php");
        $categories = get($query, $db);  

        // création de la requête sous catgéorie
        //---- Faite au moment de la selection de la catégorie

        // création de la requête sous catgéorie
        $query = "";
        $query.= "SELECT * FROM type_favori";
        /* require("script/get.php"); déjà demandé pour les catégories*/
        $type_favoris = get($query, $db);  


        ?>

        <form method="post">
            <!-- Champ alimenté par une fonction js pour connaitre l'id de la catégorie et pouvoir ainsi filtrer les sous catégorie -->
            <input type="hidden" id="id_cat_selected"><!-- Mis à jour avec JS -->            
            <!-- Traitement en php pour connaitre la catégorie sélectionnée pour filtrer correctement les sous catégories -->
            
            <!-- Les éléments de mon formulaire pour créer un favori -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Etiquette</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="etiquette" value="<?php echo $etiquette;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Adresse</label>
                <div class="col-sm-6">
                    <input type="url" class="form-control" name="adresse" value="<?php echo $adresse;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Categorie</label>
                <div class="col-sm-6">
                    <select name="categorie" >
                        <option value=0></option>
                        <?php
                        // On affiche chaque catégorie une à une dans la liste déroulante (option)
                        foreach ($categories as $categorie) {
                        echo "<option onclick=\"getCatSelected(".$categorie['id_cat'].")\" value=\"".$categorie['id_cat']."\"";
/*                         if ($categorie['departement_region']==$regionSelected){
                            echo " selected";
                        } */
                        echo ">".$categorie['categorie']."</option>";
                        }
                        ?>
                    </select>
                    <?php 
                        // création de la requête sous catgéorie
                        $query = "";
/*                         $query.= "  SELECT t3.ss_categorie
                                    FROM categorie_ss_categorie AS t1
                                    JOIN categorie AS t2
                                    ON t1.id_cat = t2.id_cat
                                    JOIN ss_categorie AS t3
                                    ON t1.id_ss_cat = t3.id_ss_cat
                                    WHERE t1.id_cat = ".$categorieSelected; */
                        /* require("get.php"); */
                        $query .= "SELECT * FROM ss_categorie";
                        $ss_categories = get($query, $db);
                    ?>



                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Sous catgéorie</label>
                <div class="col-sm-6">
                    <select name="ss_categorie">
                        <option value=0></option>
                        <?php
                        // On affiche chaque catégorie une à une
                        foreach ($ss_categories as $ss_categorie) {
                        echo "<option value=\"".$ss_categorie['id_ss_cat']."\">".$ss_categorie['ss_categorie']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nature du favori</label>
                <div class="col-sm-6">
                    <select name="type_favori">
                        <option value=0></option>
                        <?php
                        // On affiche chaque catégorie une à une
                        foreach ($type_favoris as $type_favori) {
                        echo "<option value=\"".$type_favori['id_type']."\">".$type_favori['type_favori']."</option>";
                        }
                        ?>
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
    
</body>
</html>