<?php
require_once 'auth.php';  

if (!$userid=checkAuth()) {
    header("Location: login_hw1.php");
    exit;
}  
    

// Controllo se il modulo di cambio password è stato inviato
if (isset($_POST['submit'])){
    // Recupero i dati dal modulo
    if(!empty($_POST['vecchiaP'])&&!empty($_POST['nuovaP'])&&!empty($_POST['confermaP'])){
        echo("HAllo");
        if(strlen($_POST['nuovaP'])||strlen($_POST['vecchiaP'])<8){
            $error="Caratteri insufficienti!";
        } 
        
        echo("Sono qui");           
        $conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']) or die(mysqli_error($conn));
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);  
        
        // $vPassword = $_POST['vecchiaP'];
        $password= $_POST['nuovaP'];
        $password = password_hash($password, PASSWORD_BCRYPT); //criptazione pssw
        $username= $userinfo['username'];
        echo("HO TroVAT: " .$username);
        // $confpassword=$_POST['confermaP'];
        $query2 = "UPDATE users SET password = '$password' WHERE username = '$username'";
        $res_2 = mysqli_query($conn, $query2)  or die(mysqli_error($conn));
        
        if ($res_2 == TRUE){
            // echo "la password è stata cambiata con successo";
            header("Location: home_hw1.php");              
            mysqli_free_result($res);
            mysqli_close($conn);
            exit;           
        }
        else{
            $error="Errore durante l'aggiornamento della password.";
        }
        
        mysqli_close($conn); 

            
    }
    else if (isset($_POST["vPassword"]) || isset($_POST["password"]) || isset($_POST['confpassword'])) {
        // Se solo uno dei due è impostato
        $error= "Riempi tutti i campi!";
    }
}
   
?>

<html>
<head>
    <meta charset = "utf-8">
    <title>Cambio password - Profilo</title>
    <link rel="stylesheet" href="cambiaPass.css"/> 
    <script src="cambiaP.js" defer="true"></script>
    <link rel="icon" type="image/png" href="immagini/recuperoPass.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <header>
    <div id="logo">PISTACCHIO'S HOME</div>
    <form name = "changePass" method="post" >
    <h1>Cambio password</h1>
                <p id="vecchiaP">
                    <label>Vecchia Password</label>
                    <input type="text" name="vecchiaP" <?php if(isset($_POST["vPassword"])){echo "value=".$_POST["vPassword"];} ?>>
                    
                    <span class="error"></span>
                </p>
                <p id="nuovaP">
                    <label>Nuova Password</label>
                    <input type="text" name="nuovaP" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                    
                    <span class="error"></span>
                </p>
                <p id="confermaP">
                    <label>Conferma Password</label>
                    <input type="text" name="confermaP" <?php if(isset($_POST["confpassword"])){echo "value=".$_POST["confpassword"];} ?>>
                    
                    <span class="error"></span>
                </p>
                <?php
                if(isset($error)){
                echo "<p class='error'>$error</p>";
                }
                ?>
        <input id="accesso"  type="submit" name="submit" value="Cambia password">
       
    </form>
    </header>
</body>
</html>
