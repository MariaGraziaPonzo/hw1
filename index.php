 <?php
// include 'php/auth.php';
// if(checkAuth()){
//     header("Location: home_hw1.php");
//     exit;
// }
?> 
<html>
  <head>
    <meta charset="utf-8">
    <title>Bronte e il pistacchio - Home</title>
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&amp;display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="immagini/pistacchio.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
      <header>
        <div id="overlay">
        <nav>
            <div class="contenit">
        <h1><strong>PISTACCHIO'S HOME</strong></h1>
        <div id="commento">
        <?php
            if(isset($_SESSION['username'])){
            echo "Benvenuto!";
            echo $_SESSION["username"];
            echo " !";
            }else{
                echo "Il pistacchio in un click,
                </br> accedi per visualizzare i contenuti!";
            }
        ?>
        </div>
          </div>
        
            <div id="Links">
                <!-- <a href="home_hw1.php">Home</a>
                <a  id="shop" href="shop_hw1.php">Shop</a>
                <a  id="ricette" href="ricette_hw1.php">Ricette</a> -->
                <?php
                // session_start();
                  if(!isset($_SESSION['username']))
                   echo "<a id='login' href='login_hw1.php'>Login</a>";
                  else{
                   header("Location: home_hw1.php");
                  }
                ?>
            </div>
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>

        </nav>
        
        </div>
      </header>  
    <footer>
        <div id="container">
        <span class="footerc">Powered by Maria Grazia Ponzo </span>
        <p>1000014719</p>
        </div>
        
    </footer>
  </body>
</html>