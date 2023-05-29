<?php

  require_once 'auth.php';
  $userid=checkAuth();
  if ($userid==0) {
  header("Location: login_hw1.php");
  exit;
  }
    
  
?>
 

<html>
  <?php
  
// Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
    $conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
?>

  <head>
    <meta charset="utf-8">
    <title>Bronte e il pistacchio - Home</title>
    <link rel="stylesheet" href="home.css">
    <script src="api_base.js" defer="true"></script>
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
            <div class="Links">
            <a id='ricette' href='ricette_hw1.php'>Ricette</a>
            <a  id="preferiti" href="preferiti_hw1.php">Preferiti</a>
            
            <!-- <a  id='shop' href='forum.php'>Forum</a> -->
            
            <a id='profilo' href='profilo.php'> 
              <?php echo $userinfo ['username'] ?>
              <img src="<?php echo $userinfo ['propic']== null ? "immagini/user.png" : $userinfo['propic'] ?>"> 
           </a>
            
            <a id='logout' href='logout.php'>Logout</a>
             
            </div>
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
              </div>

        </nav>
        <div class="contenit">
        <h1><strong>PISTACCHIO'S HOME</strong></h1>
        <div id="commento">
        <p>Benvenuto!</p>
        </div>
          </div>
        </div>
      </header>
      <div class="contenuto">
        <div id="info">
            <p>
            Bronte è un comune italiano di 18.149 abitanti della
            città metropolitana di Catania in Sicilia. Si estende
             alle pendici occidentali dell'Etna. È un comune del
             Parco dell'Etna e del Parco dei Nebrodi conosciuto
             per la varietà del pistacchio verde di Bronte.
            </p>
        </div>
        <strong id="titolo">IL PISTACCHIO DI BRONTE</strong>
        <div class="dettagli">
          <section>
            <strong>ORO VERDE DELL’ETNA</strong>
         <p>Longevo e resistente, capace di crescere 
          abbarbicato su terreni lavici e scoscesi, il 
          pistacchio verde è, a buon pro, il simbolo della città 
          di Bronte e del suo territorio, le pendici dell’Etna, 
          suo habitat d’eccellenza di cui rappresenta la maggior 
          fonte di ricchezza. Se il pistacchio è chiamato “oro 
          verde”, è oltre che per il colore verde smeraldo, per 
          quelle caratteristiche organolettiche, derivate da un 
          microclima irripetibile altrove, che ne fanno un frutto 
          d’alto pregio, eccellente per dimensioni e sapore 
          rispetto ai pistacchi provenienti da Grecia, Medio Oriente,
           California o Argentina.</p>
           <img src="http://localhost/mioServer/hw1/immagini/Pianta.jpg"/>
          </section>
          <section>
            <strong>IL SEGRETO DI UN GUSTO INCONFONDIBILE</strong>
            <p>È la raccolta ogni 2 anni che fa del Pistacchio di
               Bronte Dop un frutto unico: solo così la pianta ha 
               il tempo di assorbire dal terreno lavico in cui cresce,
                tutte quelle sostanze nutritive che rilasciano al frutto
                 poi il suo inconfondibile aroma, il profumo e un sapore 
                 che non ha eguali. E che permette a noi di trasformarlo 
                 nelle nostre dolci squisitezze.
          </p> 
          
          <img src="http://localhost/mioServer/hw1/immagini/02.jpg"/>
          
          </section>

          <section>
            <strong>UN FRUTTO ANTICO PER TRADIZIONE</strong>
            <p>
            Pianta di origini persiane originaria del bacino del 
            Mediterraneo, il pistacchio si trova citato persino 
            nell’Antico Testamento e veniva coltivato già al tempo 
            degli ebrei per il suo prezioso frutto. In Sicilia furono 
            gli arabi durante la loro dominazione a sviluppare la 
            coltivazione di questa pianta dal frutto particolare. 
            Oggi da noi viene utilizzato per alcune preparazioni dolci 
            e salate, come creme, pesto e panettoni. Il risultato sono 
            prodotti dal gusto più intenso e deciso.
          </p>
          <img src="http://localhost/mioServer/hw1/immagini/3.jpg"/>
          </section>
        </div>

        
          <form id ="api" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <label>Keyword:</label>
          <input type="text" name="keyword" id ="inserimento" >
          <input class = "accesso" type="submit" value="Get More Images">
          <p class="avviso"></p>
          </form>

          <div id="estero" class="show_images"> 
                    
            <!-- Modale -->
            <!-- <div id="Mbare" class="modalnon">
                <span class="modal-content">
                    <img id="modalimage" src="">
                </span>
            </div> -->
        </div>
    </div>



    <footer>
        <div id="container">
        <span class="footerc">Powered by Maria Grazia Ponzo </span>
        <p>1000014719</p>
        </div>

        <div id="weather">
          <p id="caricamento">Caricamento...</p>
            </div>
    </footer>
  </body>
</html>