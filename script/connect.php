<?php
    // Ouverture d'une connection
    function connection($hote, $bd_name, $user, $pwd){
        try
        {
            $db = new PDO('mysql:host='.$hote.';dbname='.$bd_name.';charset=utf8',$user,  $pwd,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
            return $db;
        }
        catch (Exception $e)
        {
            echo 'Connexion ratée';
            die('Erreur : ' . $e->getMessage());
        }
    }

?>