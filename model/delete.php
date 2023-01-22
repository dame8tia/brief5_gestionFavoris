<?php 
    delete();

    function delete() {

        if (isset($_GET["id"])) {

            $id = HtmlEntities(intval($_GET["id"]));

        } else { echo "Valeur reçue incorrecte.";}

        if(isset($id)){

            require("connect.php") ;   
            $db = connection('localhost', 'favoris', 'root','');
            
            $query = 'DELETE FROM favori WHERE id = :id_a_suppr';
            $query = $db->prepare($query);
            $query->bindValue('id_a_suppr', $id, PDO::PARAM_INT);
            $resultat_exec = $query->execute();  
        }

        /* echo "<script>".deleteConfirmed($resultat_exec)."</script>"; */

        header("location: /brief5/index.php");
        exit;   
        
        return $resultat_exec;

    }

    echo "<script ".
    "src=\"../script/box_confirm_delete.js\">".
    "</script>";
