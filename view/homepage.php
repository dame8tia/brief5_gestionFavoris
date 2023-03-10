
<?php 
/* $root = realpath($_SERVER["DOCUMENT_ROOT"]);
require("$root/brief5/model/authentification.php");

$connecte = est_connecte();

echo $connecte ;
if (!$connecte){
    header("location: /brief5/view/login.php");
    echo "j'y suis";
    exit();
} */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $title; ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Pour styliser les tableaux notamment colonne triée  Documentation trouvée : https://datatables.net/examples/basic_init/zero_configuration.html-->
        <!-- Adding datatable CSS CDN-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css"/>
        <!-- Adding JQuery CDN-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"> </script>    
        <!-- Adding dataTable CDN -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script>
        <!-- Appel du script JS -->
    <script src="script/datatable_style.js"></script>
    <!-- fin -->

    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="script/box_confirm_delete.js"></script>
</head>


<body>

    <div class="container">
        <h1 >Gestion des favoris d'un utilisateur</h1>
        
        <!-- Bouton Ajouter un favori : Lance un formulaire php : form_create.php -->
        <a class="btn btn-primary" href="view/form_create.php" role="button">Ajouter un favori</a>
        
        <table id="tab_favorite" class="table table-responsive table-striped overflow-auto table-hover table-bordered border-primary-subtle mt-5">
        <caption style="caption-side:bottom">Liste des favoris </caption>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Etiquette</th>
                    <th scope="col">Description</th>
                    <th scope="col">Adresse URL</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Sous catégorie</th>
                    <th scope="col">Type favori</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>    
            
            <tbody class="table-group-divider">
                <?php
                // On affiche chaque recette une à une
                foreach ($data as $ligne) {
                ?>
                <tr>
                    <th scope="row" ><?=$ligne['nom'];?></th>
                    <td><?= $ligne['etiquette'];?></td>
                    <td><?= $ligne['descript'];?></td>
                    <td> <a href="<?= $ligne['adresse_url'];?>" target ="_blank" >  <?= $ligne['adresse_url'] ?></a></td> <!--  -->
                    <td><?= $ligne['categorie']?></td>
                    <td><?= $ligne['ss_categorie']?></td>
                    <td><?= $ligne['type_favori']?></td>
                    <td>
                        <!-- Création des deux icones, dans une balise HTML <a> -->
                        <a href="view/form_edit.php?id=<?= $ligne['id']?>" class="edit" title="Edit"><span><i class="bi bi-pencil-square"></i><span></a>
                        <!-- Bouton delete : En JS function (id_à_su^pirmer) ouverture d'un message de confirmation ; si oui lancement du script delete.php -->
                        <a href="#" class="delete" title="Delete" onclick ="confirmDelete(<?= $ligne['id']?>)"><span><i class="bi bi-trash3-fill"></i><span></a>
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