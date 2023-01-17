<?php
     function get($query, $db){
        $db = $db ;
        $query = $db->prepare($query);
        $query->execute();
        $data = $query->fetchAll();
        
        return $data;
    }


