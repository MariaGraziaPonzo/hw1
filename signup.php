<?php
     require_once 'auth.php';  

     if (checkAuth()) {
        header("Location: home_hw1.php");
        exit;
    }   
    
        //verifico l'esistenza dell'inserimento
        if(!empty($_POST["username"])&&!empty($_POST["password"])&&
        !empty($_POST["nome"])&&!empty($_POST["cognome"])
        &&!empty($_POST["email"])&&!empty($_POST["confpassword"])&&!empty($_POST["allow"])){

            
            $conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']) or die(mysqli_error($conn));
            $error=array();    
            
            //pattern username
            if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/',$_POST['username'])){
                $error[]="Username non valido!";
            }
            else{
                $username= mysqli_real_escape_string($conn,$_POST['username']);
                //cerc se esise già esiste
                $query=" SELECT * from users where username ='".$username."'";
                
                $res=mysqli_query($conn,$query);

                if(mysqli_num_rows($res)>0){
                    $error[]="Username già esistente!";
                }
            }
            
            //password
            if(strlen($_POST['password'])<8){
                $error[]="Caratteri insufficienti!";
            }
            if(strcmp($_POST['confpassword'],$_POST['password'])!=0){
                $error[]="Password non coincidenti!";
            }

            //email
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $error[]="Email non valida!";
            }else {
                $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
                $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
                if (mysqli_num_rows($res) > 0) {
                    $error[] = "Email già utilizzata";
                }
            }

                # UPLOAD DELL'IMMAGINE DEL PROFILO  
            if (count($error) == 0) { 
                if ($_FILES['avatar']['size'] != 0) {
                    $file = $_FILES['avatar'];
                    $type = exif_imagetype($file['tmp_name']);
                    $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');
                    if (isset($allowedExt[$type])) {
                        if ($file['error'] === 0) {
                            if ($file['size'] < 7000000) {
                                $fileNameNew = uniqid('', true).".".$allowedExt[$type];
                                $fileDestination = 'immagini/'.$fileNameNew;
                                move_uploaded_file($file['tmp_name'], $fileDestination);
                            } else {
                                $error[] = "L'immagine non deve avere dimensioni maggiori di 7MB";
                            }
                        } else {
                            $error[] = "Errore nel carimento del file";
                        }
                    } else {
                        $error[] = "I formati consentiti sono .png, .jpeg, .jpg e .gif";
                    }
                }else{
                    $error[]= "Non hai caricato nessuna immagine" ;
                }
            }

            //registrazione nel database
            if(count($error)==0){
                $nome= mysqli_real_escape_string($conn,$_POST['nome']);
                $cognome= mysqli_real_escape_string($conn,$_POST['cognome']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password= mysqli_real_escape_string($conn,$_POST['password']);
                $password = password_hash($password, PASSWORD_BCRYPT); //criptazione pssw
                // echo("vediamo: "+$fileDestination);

                $query_1="INSERT INTO users(username, password, email,
                name, surname,  propic) VALUES('$username',
                 '$password','$email',  '$nome', '$cognome', 
                 '$fileDestination')";

                 if(mysqli_query($conn,$query_1)){
                     $_SESSION["__username"]=$_POST["username"];
                     $_SESSION["user_id"] = mysqli_insert_id($conn);
                     header("Location: home_hw1.php");     
                     mysqli_free_result($res);
                     mysqli_close($conn);
                     exit;
                    }
                    else{
                        $error[] = "Errore di connessione al Database";
                    }
            }
            mysqli_close($conn);
        }
       
        else if (isset($_POST["username"]) || isset($_POST["password"])|| isset($_POST["nome"])|| 
        isset($_POST["cognome"])|| isset($_POST["email"])|| isset($_POST["confpassword"])) {
            
            $error[]= "Riempi tutti i campi!";
           }
?>
<html>

  <head>
  <meta charset="utf-8">
    <title>Account - Signup</title>
    <link rel="stylesheet" href="signup.css"/> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <script src="signup.js" defer="true"></script>
    <link rel="icon" type="image/png" href="immagini/register.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>

       <header>
       <div id="logo">PISTACCHIO'S HOME</div>
        <form name="signup" method="post" enctype="multipart/form-data" >
                <h1>Registrati gratuitamente</h1>
                <p id="nome">
                    <label>Nome</label>
                    <input type="text" name="nome" <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>>
                    <!-- <span class="error"><img src="./immagini/close.svg"/><span>Devi inserire il tuo nome</span></span> -->
                    <span class="error"></span>
                </p>
                <p id="cognome">
                    <label>Cognome</label>
                    <input type="text" name="cognome" <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?>>
                     <!-- <span class="error"><img src="./immagini/close.svg"/><span>Devi inserire il tuo cognome</span></span> -->
                    <span class="error"></div>
                </p>
                <p id="email">
                    <label>E-Mail</label>
                    <input type="text" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                    <!-- <span class="error"><img src="./immagini/close.svg"/><span>Indirizzo email non valido</span></span> -->
                    <span class="error"></span>
                </p>
                <p id="username">
                    <label>Username</label>
                    <input type="text" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    <!-- <span class="error"><img src="./immagini/close.svg"/><span>Nome utente non disponibile</span></span> -->
                    <span class="error"></span> 
                </p>
                <p id="password">
                    <label>Password</label>
                    <input type="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                    <!-- <span class="error"><img src="./immagini/close.svg"/><span>Inserisci almeno 8 caratteri</span></span> -->
                    <span class="error"></span>
                </p>
                <p id="conferma">
                    <label>Conferma Password</label>
                    <input type="password" name="confpassword" <?php if(isset($_POST["confpassword"])){echo "value=".$_POST["confpassword"];} ?>>
                    <!-- <span class="error"><img src="./immagini/close.svg"/><span>Le password non coincidono</span></span> -->
                    <span class="error"></span>
                </p>
                <p class="fileupload">
                    <label for='avatar'>Scegli un'immagine profilo</label>
                        <input type='file' name='avatar' accept='.jpg, .jpeg, image/gif, image/png' id="upload_original">
                        <!-- <div id="upload">
                             <div class="file_name"> 
                                Seleziona un file...</div><div class="file_size"></div> -->
                    <span class="error"></span></div> </div>
                   
                </p>
                <p id="consenti"> 
                    <label>
                        <input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>>
                        <label for='allow'>Acconsento al trattamento dei dati personali</label>
                    </label>
                </p>
                
                <div id="registrati">
                    <input id="accesso" type='submit' value="Registrati">
                </div>
                <?php
                if(isset($error)){
                    foreach($error as $err){
                echo "<p class='error'><span>$err</span></p>";
                    }
                }
                ?>
                <div id="testo">
                    Hai già un account?<a href="login_hw1.php">Accedi</a>
                </div>
         </form>
        </header>
  </body>
    
</html>