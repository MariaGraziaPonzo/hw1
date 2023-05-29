<?php
    require_once 'dbconfig.php';

    // Distruggo la sessione esistente
    session_start();
    session_destroy();

    header('Location: login_hw1.php');
?>