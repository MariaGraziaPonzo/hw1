<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login_hw1.php");
        exit;
    }
?>

<html>
<?php
// Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
$error=array();     
$conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
?>
    <head>
    <meta charset="utf-8">
    <title>Preferiti</title>
    <link rel="stylesheet" href="preferiti.css"/> 
    <!-- <script src="js/preferiti.js" defer="true"></script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="immagini/checked.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
</head>
    <body>
    <header>
            <div id='overlay'>
            <nav>
            <div class="Links">
                <a href="home_hw1.php">Home</a>
                <!-- <a  id="shop" href="forum.php">Forum</a> -->
                <a id='ricette' href='ricette_hw1.php'>Ricette</a>
                <a id='profilo' href='profilo.php'> 
                    <?php echo $userinfo ['username'] ?>
                    <img src="<?php echo $userinfo['propic']== null ? "immagini/user.png" : $userinfo['propic'] ?>"> 
                 </a>
                <?php
                // session_start();
                  if(isset($_SESSION['username']))
                   echo "<a id='login' href='login_hw1.php'>Login</a>";
                  else{
                    // echo"<a id='carrello' href='carrello_hw1.php'>Carrello</a>";
                    echo "<a id='logout' href='logout.php'>Logout</a>";
                  }
                ?>
            </div>
            <div class="hidden" id="menu_ext">
                  <a href="carrello_hw1.php">Carrello</a>
                  <!-- <a id="shop" href="forum.php">Forum</a> -->
                  <?php
                    if(!isset($_SESSION['username']))
                      echo "<a id='login' href='login_hw1.php'>Login</a>";
                    else{
                      
                      echo "<a id='logout' href='logout.php'>Logout</a>";
                    }
                  ?>
            </div>
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div> 
                     
            </nav>
            
            <strong>I TUOI PREFERITI!</strong>
            </div>              
    
        </header>
        <img class="Profilo"src="<?php echo $userinfo ['propic']== null ? "immagini/user.png" : $userinfo['propic'] ?>">
        <h4 class="Nome"><?php echo $userinfo['name']." ".$userinfo['surname']?></h4>
        <h4 class="aggiornamento"><?php echo $userinfo ['username'] ?></h4>
        
          <div id= "tutto">
         
           
          </div>
    <footer>
        <span class="footerc">Powered by Maria Grazia Ponzo </span>
        <p>1000014719</p>
    </footer>
    </body>
</html>
    