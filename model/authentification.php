<?php 
function est_connecte():bool{
    
    if (session_status() === PHP_SESSION_NONE) {
        echo "session démarée (authen): ";
        
        session_start();
        unset($_SESSION['login']);
    }
    echo '$_SESSION :',$_SESSION['login'];
    return !empty($_SESSION['login']);
}

?>