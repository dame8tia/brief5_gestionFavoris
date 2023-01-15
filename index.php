<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion des favoris</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style/style.css">

    <script src="script/box_confirm_delete.js"></script>


</head>
<body>
    <h1 >Gestion des favoris d'un utilisateur</h1>

    <?php
        require("script/connect.php") ;   
        $db = connection('localhost', 'favoris', 'root','');     
    ?>

    <?php

        if (isset($db)){
            // affiche les favoris : LEFT JOIN pour les favoris sans catégories
            $selectFavoris = 
            'SELECT t1.id, t1.nom, t1.etiquette, t1.descript, t1.adresse_url, t2.categorie, t3.ss_categorie, t4.type_favori
            FROM favori AS t1
            LEFT OUTER JOIN categorie AS t2
            ON t1.id_cat = t2.id_cat
            LEFT OUTER JOIN ss_categorie AS t3
            ON t1.id_ss_cat = t3.id_ss_cat 
            LEFT OUTER JOIN type_favori AS t4
            ON t1.id_type = t4.id_type ;';

            require("script/get.php");
            $favoris = get($selectFavoris, $db);

            
        }
        else { echo "Pas de connexion à la base de données";}
        
    ?>

    <div class="container">
        <!-- Bouton Ajouter un favori : Lance un formulaire php : form_create.php -->
        <a class="btn btn-primary" href="form_create.php" role="button">Ajouter un favori</a>
        
        <table class="table table-responsive table-striped overflow-auto table-hover table-bordered border-primary-subtle mt-5">
        <caption style="caption-side:bottom">Liste des favoris </caption>
            <thead>
                <tr>
                    <th scope="col">Nom <i class="fa fa-sort"></i></th>
                    <th scope="col">Etiquette <i class="fa fa-sort"></i></th>
                    <th scope="col">Description</th>
                    <th scope="col">Adresse URL</th>
                    <th scope="col">Catégorie <i class="fa fa-sort"></i></th>
                    <th scope="col">Sous catégorie <i class="fa fa-sort"></i></th>
                    <th scope="col">Type favori <i class="fa fa-sort"></i></th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>    
            
            <tbody class="table-group-divider">
                <?php
                // On affiche chaque recette une à une
                foreach ($favoris as $favori) {
                ?>
                <tr>
                    <th scope="row" ><?php echo $favori['nom']?></th>
                    <td><?php echo $favori['etiquette']?></td>
                    <td><?php echo $favori['descript']?></td>
                    <td> <a href="<?php echo $favori['adresse_url'] ?>" target ="_blank" >  <?php echo $favori['adresse_url'] ?></a></td> <!--  -->
                    <td><?php echo $favori['categorie']?></td>
                    <td><?php echo $favori['ss_categorie']?></td>
                    <td><?php echo $favori['type_favori']?></td>
                    <td>
                        <!-- Création des deux icones, dans une balise HTML <a> -->
                        <a href="form_edit.php?id=<?php echo $favori['id']?>" class="edit" title="Edit"><i class="bi bi-pencil-square"></i></a>
                        <!-- Bouton delete : En JS function (id_à_su^pirmer) ouverture d'un message de confirmation ; si oui lancement du script delete.php -->
                        <a href="#" class="delete" title="Delete" onclick ="confirmDelete(<?php echo $favori['id']?>)"><i class="bi bi-trash3-fill"></i></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>  
            
        
        </table>
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>