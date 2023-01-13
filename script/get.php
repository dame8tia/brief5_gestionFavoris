<?php


     function get($query, $db){
        $db = $db ;
        $query = $db->prepare($query);
        $query->execute();
        $resultats = $query->fetchAll();
        
        return $resultats;
    }


?>