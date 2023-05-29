<?php
//se gia l'utente è loggato non ha senso
include 'auth.php';
 if(checkAuth()!=0){
     header("Location: home_hw1.php");
     exit;
 }
    
    if(!empty($_POST["username"])&&!empty($_POST["password"])){
        
        $conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']) or die(mysqli_error($conn));
        
        $username= $_POST['username'];
        $password = $_POST['password'];
        // echo ("Us:".$username."PAss:".$password);
        $query=" SELECT * FROM users WHERE username ='$username'";
        
        
        //esecuzione
        $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
        // $res=$conn->query($query);
        if(mysqli_num_rows($res)>0){
                      
            //1 sola riga ritorna, perchè il cliente loggato è 1
            $entry=mysqli_fetch_assoc($res);
            //  echo "Sono entratataala password :".$entry['password']. "DECRIPTATA".$_POST['password'];
          
             if(password_verify($_POST['password'],$entry['password'])){  
                
                // echo "esiste";
                //sessione utente
                $_SESSION["__username"]=$entry["username"];
                $_SESSION["user_id"] = $entry['id'];
                echo "sono qua";
                header("Location: home_hw1.php");              
                
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            // }   
            }
            echo("sono usct" );
            
        } 
        else{
            // echo("non ho trovato nulla");
        $error= "Username e/o password errati o non trovati.";
        }
        mysqli_close($conn);
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
     // Se solo uno dei due è impostato
     $error = "Inserisci username e password.";
    }
?>

<html>

    <head>
        <meta charset="utf-8">
        <title>Account - Login</title>
        <link rel="stylesheet" href="login.css"/> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
        <script src="login.js" defer="true"></script>
        <link rel="icon" type="image/png" href="immagini/login.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>
    
       <header>  
        <div id="tutto">   
       <div id="logo">PISTACCHIO'S HOME</div>       
        <form  name="login" method="post">
        
                <h1> Effettua il Login:</h1>
                <p id="username">
                    <label>Username</label>
                    <input type="text" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                   
                    <span class="error"></span> 
                </p>
                <p id="password">
                    <label>Password</label>
                    <input type="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                    
                    <span class="error"></span>
                </p>
                <p>
                    <label><input id="accesso" type='submit' value="Accedi"></label>
                </p>
              
            <?php
            if(isset($error)){
                echo "<p class='error'>$error</p>";
            }
            ?>            
        </form>     
        <div id="con">
                <p id="testo">Non hai un account? <a href="signup.php">Registrati</a></p>
                <p id="recupera">Hai dimenticato la tua password? <a href= "recupera.php">Recupera Password</a></p>
            </div>
        </div>
        </header>
       
    </body>
    
</html>
