<?php
    /********************************************************
       Controlla che l'utente sia già autenticato, per non 
       dover chiedere il login ad ogni volta               
    *********************************************************/
    require_once "dbConfig.php";
    session_start();

    function checkAuth() {
        GLOBAL $dbConfig;
        // echo("sono qui" .$_SESSION['user_id']);
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
        if(isset($_SESSION['user_id'])) {
            
            // echo ($_SESSION['user_id']);
            return $_SESSION['user_id'];
           
        } else 
        // echo("No");
            return 0;
    }
?>