<?php
require_once 'auth.php';  

if (!$userid= checkAuth()) {
   header("Location: home_hw1.php");
   exit;
}  
// Connessione al database
$conn = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']) or die(mysqli_error($conn));
$userid = mysqli_real_escape_string($conn, $userid);

$query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);


if (mysqli_num_rows($res_1)>0){
    $userinfo = mysqli_fetch_assoc($res_1);   

    $username = $userinfo["username"];
    
    // Verifica se l'utente ha inviato la richiesta di eliminazione dell'account
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteAccount"])) {
        // Visualizza l'avviso di conferma
        echo '
        <script>
            var conferma = confirm("Sei sicuro di voler eliminare il tuo account?");
            if (conferma) {
                
                var form = document.getElementById("deleteForm");
                form.submit();
            } else {
                exit;
            }
        </script>
        ';
    }

    // Verifica se l'utente ha confermato l'eliminazione dell'account
    if (isset($_POST["confirmedDelete"])) {
        // Elimina l'account dal database
        $query2 = "DELETE FROM users WHERE username = '" . $username . "'";
        $res_2 = mysqli_query($conn, $query2);
        
        // if (mysqli_num_rows($res_2)<=0) {
                        
            // mysqli_free_result($res_2);
            mysqli_close($conn);
            header("Location: logout.php");
            exit;
        // } else {
        //     $error= "Errore durante l'eliminazione dell'account: " . $conn->error;
        // }
    }
    mysqli_free_result($res_1);
}
// Chiudi la connessione al database
mysqli_close($conn);
?>


<html>
<head>
    <title>Elimina Profilo - Profilo</title>
    <link rel="stylesheet" href="delete.css"/> 
    
    <link rel="icon" type="image/png" href="immagini/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        function showConfirmation() {
            var conferma = confirm("Sei sicuro di voler eliminare il tuo account?");
            if (conferma) {
                // Invia il modulo confermato
                var form = document.getElementById("deleteForm");
                form.submit();
            } else {
                exit;
            }
        }
    </script>
</head>
<body>
    <header>
    <div id="logo">PISTACCHIO'S HOME</div>
    <h2>Elimina Account</h2>
    
    <p>Sei sicuro di voler eliminare il tuo account? Questa azione è irreversibile.</p>
    <form id="deleteForm" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="confirmedDelete">
        <input type="button" onclick="showConfirmation()" value="Elimina Account">
    </form>
    </header>
</body>
</html>
