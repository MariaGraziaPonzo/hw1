<?php
/* Controlla che i l'email sia unica*/
    require_once 'dbConfig.php';
    
if(isset($_GET['q'])){
    // Imposto l'header della risposta
    header('Content-Type: application/json');
    
    //connetto db
    // $conn= mysqli_connect("localhost","root","","database");
    $conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']);
    //leggo
    $email = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT email FROM users WHERE email = '$email'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    /*Torna un JSON con chiave exists e valore boolean
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));
*/
    $emailArray=Array();
    if(mysqli_num_rows($res)>0){
        $emailArray=array('exists'=>true);
    }else{
        $emailArray=array('exists'=>false);
    }
    echo json_encode($emailArray);

    mysqli_close($conn);
}
else{
    // Controllo che l'accesso sia legittimo
        echo "Non dovresti essere qui";
    exit;
}
?>