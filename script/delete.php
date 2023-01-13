<?php 
if(isset($_GET["id"])){
    $id = $_GET["id"] ;
    require("connect.php") ;   
    $db = connection('localhost', 'favoris', 'root','');
    
    $query = 'DELETE FROM favori WHERE id = :id_a_suppr';
    $query = $db->prepare($query);
    $query->bindValue('id_a_suppr', $id, PDO::PARAM_INT);
    $resultat_exec = $query->execute();    
}

header("location: /brief5/index.php");
exit;
?>