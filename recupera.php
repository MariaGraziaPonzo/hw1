<?php
  require_once 'auth.php';  

  if (checkAuth()) {
     header("Location: home_hw1.php");
     exit;
 }   

if (!empty($_POST["email"])&& (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))){
    $conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']) or die(mysqli_error($conn));
    $error= array();
        
    $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));

    
    // Genera una nuova password casuale
    $newPassword = generateRandomPassword();
    
    $query= "UPDATE users SET password = '".$newPassword."' WHERE email = '".$email."'";
    
    $res= mysqli_query($conn,$query);      
     
    if (mysqli_num_rows($res) ==1){
        echo (" SONO ENTRATA:" ); 
        $to = $_POST['email'];
        $subject = "Recupero password";
        $message = "La tua nuova password è: " . $newPassword;
        $headers = "From: recuperoPassw@gmail.com" . "\r\n";
        echo (" SONO QUI:" .$to);
        if (mail($to, $subject, $message, $headers)) {
            echo "La tua nuova password è stata inviata via email.";
            header("Location: login_hw1.php");     
            mysqli_free_result($res);
            mysqli_close($conn);
            exit;
        } else {
            echo "Errore durante l'invio della nuova password.";
        }
    } else{
        echo("ssb");
        $error="Nessun utente registrato a questa mail";
    
    } 
    mysqli_close($conn);
}else{
    // $error="Inserisci una mail corretta!";
}

// Funzione per generare una password casuale
function generateRandomPassword($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }

    return $password;
}
?>


<html>
<head>
    <meta charset = "utf-8">
    <title>Recupero password - Profilo</title>
    <link rel="stylesheet" href="recupera.css"/> 
    <script src="recupera.js" defer="true"></script>
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
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <h1>Recupero password</h1>
    <p id="email">
                    <label>E-Mail</label>
                    <input type="text" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                    <!-- <span class="error"><img src="./immagini/close.svg"/><span>Indirizzo email non valido</span></span> -->
                    <span class="error"></span>
                </p>
                <?php
                if(isset($error)){
                echo "<p class='error'>$error</p>";
                }
                ?>
        <input id="accesso"  type="submit" value="Recupera password">
       
    </form>
    </header>
</body>
</html>
