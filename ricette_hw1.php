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
    $conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
?>
    <head>
    <meta charset="utf-8">
    <title>Ricette</title>
    <link rel="stylesheet" href="recipe_hw1.css"/> 
    <script src="recipe.js" defer="true"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="immagini/ric.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
</head>
    <body>
        <header>
            <div id='overlay'>
            <nav>
            <div id="Links">
                <a href="home_hw1.php">Home</a>
                <!-- <a  id="shop" href="forum.php">Forum</a> -->
                
                <a  id="preferiti" href="preferiti_hw1.php">Preferiti</a>
                <a id='profilo' href='profilo.php'> 
                    <?php echo $userinfo ['username'] ?>
                    <img src="<?php echo $userinfo['propic']== null ? "immagini/user.png" : $userinfo['propic'] ?>"> 
                 </a>
                 <?php
                    if(isset($_SESSION['username']))
                      echo "<a id='login' href='login_hw1.php'>Login</a>";
                    else{
                      echo "<a id='logout' href='logout.php'>Logout</a>";
                    }
                  ?>
            </div>
            <div class="hidden" id="menu_ext">
                  <!-- <a href="carrello_hw1.php">Carrello</a> -->
                  <!-- <a id="shop" href="forum.php">Forum</a> -->
                  <?php
                    if(isset($_SESSION['username']))
                      echo "<a id='login' href='login_hw1.php'>Login</a>";
                    else{
                      echo "<a id='user' href='profilo.php'> ";
                      echo $_SESSION["username"] . " </a>";
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
            <div id="superiore">
            <h1>Consigli: </br><strong>TOP 5 RICETTE COL PISTACCHIO</strong></h1>
                </div>
        </header>
    
    <div id="tutto">
    <section>        
            <div class="indice">1.</div>
            <div class="contenuto">
                <div class="Titolo">
                <h1>PACCHERI CON GUANCIALE, CREMA DI BURRATA E PISTACCHIO</h1>
                <p class="voto"><strong>Voto: 10</strong></p>
                 </div>
                <div class="details">  
                <p>Un primo piatto golosissimo adatto anche alle grandi occasioni. La burrata, i pistacchi 
                e il guanciale croccante rendono questa ricetta 
                irresistibile.</p>          
            
                <em >
                    
                    I paccheri con guanciale, crema di burrata e pistacchi sono 
                    un primo piatto gustoso e avvolgente. La delicatezza 
                    e la scioglievolezza del latticino di origine pugliese 
                    si sposano perfettamente con la sapidità caratteristica 
                    del salume e la piacevole croccantezza della granella di 
                    pistacchi. </br>
                    Il risultato è un condimento irresistibile, 
                    cremoso e anche molto facile da realizzare, ideale 
                    condimento di una pasta corta porosa, che trattiene 
                    tutto i sapori e i profumi. La guarnizione finale 
                    con i fiocchi di burrata conferirà al piatto un 
                    tocco di piacevole freschezza. Una pietanza ricca e importante, da servire
                     in occasione del pranzo della domenica e che conquisterà 
                     grandi e piccini. Scoprite come realizzarla alla 
                     perfezione seguendo passo passo la nostra ricetta.
                </em>
                <p class="val"><strong>Ottimo.</strong></p>
                <img src="https://staticcookist.akamaized.net/wp-content/uploads/sites/21/2020/10/DSC_4588-1200x675.jpg"/>            
            </div>          
        </div>
    </section>

    <section >
        <div class="indice">2.</div>
        <div class="contenuto">
        <div class="Titolo">
            <h1>GELATO AL PISTACCHIO</h1>
            <p class="voto"><strong>Voto: 9                
            </strong></p>
        </div>
            <div class="details">
                <p>
                    
                        Il gelato al pistacchio è un must della 
                pasticceria italiana. Gusto classico e 
                irresistibile è perfetto da mangiare, come 
                tradizione siciliana comanda, con una calda 
                e fragrante brioche col tuppo o come 
                delizioso dessert di fine pasto.
                    
                </p>
                <em>
                    Si prepara semplicemente con pasta di 
                    pistacchio, panna montata e latte condensato,
                     miscelati insieme e fatti raffreddare in 
                     freezer per 6 ore: tre soli ingredienti per 
                     una ricetta facile e alla portata di tutti 
                     che non prevede l’ausilio di una gelatiera.
                </em>
                <p class="val"><strong>Ottimo.</strong></p>
                <img src="https://assets.tmecosys.com/image/upload/t_web767x639/img/recipe/vimdb/123651_898-0-5404-5404.jpg">
            </div>
        </div>
    </section>
    
    <section>
        <div class="indice">3.</div>
        <div class="contenuto">
        <div class="Titolo">
            <h1>TORTA AL PISTACCHIO</h1> 
            <p class="voto"><strong>Voto: 8                 
            </strong></p>           
        </div>
        <div class="details">
            <p>
                
                    La torta al pistacchio è una delle ricette 
                simbolo di Bronte, ridente cittadina Siciliana, 
                alle pendici dell’Etna. 
                
            </p>
            <em>
                Preparata con una base soffice al pistacchio, 
                ripiena di golosa crema. Un tripudio di sapori 
                che amerete subito, fin dal primo boccone. 
                Un’ottima torta da servire come dolce a fine 
                pasto, perfetta anche per occasioni importanti 
                come Feste o compleanni.</br>

                La ricetta invece mi è stata donata da una mia 
                gentile lettrice di Bronte, la signora Lorella 
                che ringrazio pubblicamente.</br>

                La farina di pistacchio sarebbe il pistacchio 
                grattuggiato finemente, si trova in tutti i 
                supermercati ben forniti. Stessa cosa per la 
                crema dolce di pistacchi.
            </em>

            <p class="val"><strong>Delizioso.</strong></p>
            <img src="https://www.dolcidessert.it/wp-content/uploads/bfi_thumb/torta-al-pistacchio-di-bronte-3ahnc2gd0rp78b134851qi.jpg">
        </div>
        </div>
    </section>
    <section>
        <div class="indice">4.</div>
        <div class="contenuto">
            <div class="Titolo">
                <h1>INVOLTINI AL PISTACCHIO</h1>
                <p class="voto"><strong>Voto: 7.5                    
                </strong></p>
            </div>
                <div class="details">
                    <p>
                        
                            Un secondo piatto sfizioso e saporito, una 
                    variante dei classici involtini di carne, 
                    ideale per un pranzo o una cena in famiglia 
                    o con gli amici.
                        
                    </p>
                    <em>
                        Utilizziamo la lonza di maiale, che sarà 
                        farcita con prosciutto cotto, formaggio 
                        cremoso, granella di pistacchi e 
                        formaggio morbido. Una volta formati gli 
                        involtini, saranno passati nelle uova, 
                        nel pangrattato e decorati con granella 
                        di pistacchi, prima di essere fritti in 
                        padella fino a doratura. Il risultato 
                        finale saranno degli involtini di pistacchi 
                        morbidi fuori e cremosi dentro.</br>
    
                        Per la preparazione abbiamo utilizziamo una 
                        granella di pistacchi ridotta quasi in 
                        polvere, ma puoi tritare i pistacchi in modo 
                        più grossolano, se preferisci una nota più 
                        croccante.
                    </em>
                    <p class="val"><strong>Sorprendente.</strong></p>
                    <img src="https://www.pepecatering.it/images/virtuemart/product/involtini-al-pistacchio.jpg">
                </div>
        </div>
    </section>
    <section>
        <div class="indice">5.</div>
        <div class="contenuto">
            <div class="Titolo">
                <h1>LASAGNE AL PISTACCHIO</h1>
                <p class="voto"><strong>Voto: 7            
                </strong></p>
            </div>
            <div class="details">
                <p>
                    
                        Le lasagne al pistacchio sono un primo 
                    piatto ricco e goloso, perfetto per il pranzo 
                    della domenica o per la tavola delle feste.
                    
                </p>
                
                <em>
                    Le sfoglie di pasta fresca all'uovo vengono 
                    scottate in acqua e poi alternate a strati con 
                    pesto di pistacchi, besciamella cremosa, provola 
                    a cubetti e pancetta arrotolata. Vengono infine 
                    cotte in forno, finché la superficie non sarà ben 
                    gratinata e dorata, per un risultato finale delicato
                     e deciso al tempo stesso, grazie al piacevole 
                     contrasto di sapori.</br>
    
                    Si tratta di una variante in bianco, molto 
                    appetitosa, delle classiche lasagne alla bolognese,
                     ideali per gli amanti del pistacchio. La sapidità 
                     della pancetta viene bilanciata dalla delicatezza 
                     della besciamella, mentre la provola regalerà un 
                     irresistibile effetto filante, che conquisterà 
                     grandi e piccini. Di facile esecuzione, nella 
                     ricetta qui proposta abbiamo usato delle sfoglie 
                     già pronte, così da velocizzare i tempi di 
                     preparazione; se lo preferite, potete mettere le 
                     mani in pasta e realizzarle in casa.</br>
    
                    Al posto della provola, potete mettere un altro 
                    formaggio a pasta filata di vostro gusto; in 
                    sostituzione della pancetta, aggiungete speck, 
                    prosciutto cotto o crudo. Per una versione 
                    vegetariana, invece, eliminate il salume e 
                    sostituitelo con zucchine grigliate, spinaci 
                    ripassati in padella o un'altra verdura di 
                    stagione. Per un gusto più deciso, cospargete 
                    gli strati di pasta con parmigiano o pecorino 
                    grattugiato.
                </em>
                <p class="val"><strong>Sorprendente.</strong></p>
                <img src="https://staticcookist.akamaized.net/wp-content/uploads/sites/21/2022/01/Lasagne-al-pistacchio-1200x675.jpg"/>
    
            </div>
        </div>
    </section>
    <form id="form1">
        <h1>PER LE TUE PROSSIME RICETTE:</h1>
        <p>Inserisci un ingrediente:</p>
        <div id="contenitore">
        <input type="text" name = "ricetta" id="richiesta">
        <input type=submit class="cerca" value="cerca">
        <p class="avviso"></p>
        </div>
        <?php
            if(isset($error)){
                echo "<p class='error'>$error</p>";
            }
            ?>  
    </form>
    
    </section>
    </div>
    <footer>
        <span class="footerc">Powered by Maria Grazia Ponzo </span>
        <p>1000014719</p>
    </footer>
    </body>
</html>
    