<?php 
    $erreur = "" ;
    $password = '$2y$14$syxV5ybCQKY8g2I1kwK8XeU.iPXODO4rbwh.IznUkQBbyc9SYUHXu'; // obtenu echo password_hash('root', PASSWORD_DEFAULT, ['cost'=>14]);
    if (!empty($_POST['login']) && !empty($_POST['motdepasse'])){
        if ($_POST['login'] === 'root' && password_verify($_POST['motdepasse'], $password)){
            if (session_status() === PHP_SESSION_NONE ) {
                echo "session démarée 2";
                session_start();
            }
            $_SESSION['login'] = $_POST['login'] ;
            header("location: /brief5/view/homepage.php");
        }
        else {;
            $erreur = "Identifiant ou mot de passe incorrect";
        }
    }
    
    
/*     if (!function_exists('est_connecte')) {  // ce test est déjà fait directement dans connect.php. L'idée est de montrer qu'on peut le faire de n'importe où
        require_once("../model/authentification.php") ;            
        
    }
    $connect = est_connecte();
    
    if ($connect){
        header('Location : view/homepage.php');
    } */



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title> 
    <!-- Title : A passer en dynamique  -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>


<body>


    <h1>Connexion</h1>
    <div class="container my-5">
        <?php if ($erreur): ?>
            <div class="alert alert-danger">
                <?= $erreur ?>
            </div>
        <?php endif?>

        <form action="" method="POST">
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Login</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="login" value="" placeholder = "root">
                    </div>
            </div>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Mot de passe</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="motdepasse" value="" placeholder = "root">
                    </div>
            </div>
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