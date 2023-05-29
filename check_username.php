<?php 
    //username unico
    require_once 'dbConfig.php';
   
    if(isset($_GET['q'])){

        header('Content-Type: application/json');
        /*$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);*/
        $conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']);

        $username = mysqli_real_escape_string($conn, $_GET["q"]);

        $query = "SELECT username FROM users WHERE username = '$username'";

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
       /* $userArray=Array();
        if(mysqli_num_rows($res)>0){
            $userArray=array('exists'=>true);
        }else{
            $userArray=array('exists'=>false);
        }
        echo json_encode($userArray);*/

        echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));


        mysqli_close($conn);
    }
    else{
        echo "Non dovresti essere qui";
        exit;
    }
?>