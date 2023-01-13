<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des favoris</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"> <!-- https://icons.getbootstrap.com/#icons OU https://icons.getbootstrap.com/#install-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="style/style.css">

</head>
<body>
    <h1 class="text-xl-start">Gestion des favoris d'un utilisateur</h1>

    <?php
        // Ouverture d'une connection pour alimenter la liste des régions du champ select 
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=favoris;charset=utf8', 'root',  '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
            // Requête pour alimenter le SELECT du choix région
            $queryFavoris = $db->prepare('SELECT * FROM favori');
            $queryFavoris->execute();
            $favoris = $queryFavoris->fetchAll();
        }
        catch (Exception $e)
        {
            echo 'Connexion ratée';
            die('Erreur : ' . $e->getMessage());
        }

    ?>

    <form method="post">
<!-- 
        <?php
            $regionSelected = '';            
            if(isset($_POST['region_select_box']))
            {
                $regionSelected = $_POST['region_select_box'];
            }
        ?>
        
        <select name="region_select_box">
            <option value=0>Choisir un sous bassin</option>
            <?php
                // On affiche chaque recette une à une
                foreach ($regions as $region) {

                /* echo $region['departement_region'] */
                echo "<option value=\"".$region['departement_region']."\"";
                if ($region['departement_region']==$regionSelected){
                    echo " selected";
                }
                echo ">".$region['departement_region']."</option>";
            ?>
                              
            
            <?php
                    }
            ?>
        </select>

        <br>
        <label for="recherche_code_dep">Recherche par code département</label>
        <input type="text" name="recherche_code_dep">        
        <br>
        <input type="submit" value="Envoyer le formulaire">
        <br>
    </form>
 -->
 
    <?php /* var_dump($_POST) */ ?> 
    
    <?php
        if (isset($_POST['region_select_box'])||isset($_POST['recherche_code_dep'])){
            try
            {
                $db = new PDO('mysql:host=localhost;dbname=geofrance;charset=utf8', 'root',  '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
            }
            catch (Exception $e)
            {
                echo 'Connexion ratée';
                die('Erreur : ' . $e->getMessage());
            }
        }
    ?>
            
    <?php
        
        $regionPost = $_POST['region_select_box'];
        $codeDepPost = $_POST['recherche_code_dep']; 
        $geofranceStatement = $db->prepare('SELECT * FROM departement WHERE departement_region = :region');
        $geofranceStatementByCode = $db->prepare('SELECT * FROM departement WHERE departement_code = :code');
    ?>
   
    

    <?php

        if ($codeDepPost!=''){ // Filtre du tableau par code de département
            $geofranceStatementByCode->execute(['code' => $codeDepPost]);
            $departements = $geofranceStatementByCode->fetchAll();
        } 
        elseif ($regionPost != ''){ // Filtre du tableau par région
            $geofranceStatement->execute(['region' => $regionPost]);
            $departements = $geofranceStatement->fetchAll();
        }   
    ?>
    
    <br>
    <br>
    <table>
    <caption style="caption-side:top">Tableau des départements</caption>
    <tr>
        <th>Code</th>
        <th>Département</th>
        <th>Région</th>
        <th>Population_2017</th>
    </tr>
    
    <?php
        // On affiche chaque recette une à une
        foreach ($departements as $departement) {
    ?>
    <tr>
        <td><?php echo $departement['departement_code']?></td>
        <td><?php echo $departement['departement_nom']?></td>
        <td><?php echo $departement['departement_region']?></td>
        <td style="text-align:right;"><?php echo $departement['population_2017']?></td>
    </tr>
    <?php
        }
    ?>
    
    </table>
    
</body>
</html>