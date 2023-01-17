<?php 
/* ------------- > Lire un tableau plus clairement : */

/*         echo "<pre>";
        var_dump($_SERVER);
        echo "</pre>"; */

        /* print_r(array_keys($_SERVER)); */

/*         foreach ($_SERVER as $k=>$v)
        echo $k . "=>" . $v . "<br>"; */

        // lecture d'une superglobale
/*         foreach($_SERVER as $field => $value){
            echo '<b>'.$field.'</b> : '.$value.'<br />';
        }
        echo '<br /><br />'; */

/* ------------- > Remttre à jour l'autoincrement : */
//ALTER TABLE categorie AUTO_INCREMENT = 7 ;
// $lastId = $db->lastInsertId();   


/* ------------- > Version php : */
/* <?php echo "version php .phpversion()".phpversion();?> */